<?php
include 'config/config.php';

// ตรวจสอบค่าที่ส่งมาใน URL
if (isset($_GET['id'])) {
    $room_id = intval($_GET['id']); // แปลงเป็นตัวเลขเพื่อป้องกัน SQL Injection
} else {
    die("❌ ไม่พบข้อมูลห้องประชุม");
}

// ดึงข้อมูลห้องประชุม
$sql = "SELECT * FROM rooms WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $room = $result->fetch_assoc();
} else {
    die("❌ ไม่พบห้องประชุมที่เลือก");
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดห้องประชุม</title>
    <link rel="stylesheet" href="/software/css/style-detail.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</head>

<body>
    <header class="fade-in">
        <nav>
            <div class="logo">
                <img src="/software/images/logo.png" alt="logo">
            </div>
            <ul>
                <li><a href="index.php">หน้าหลัก</a></li>
                <li><a href="booking.php">จองห้อง</a></li>
                <li><a href="howto.php">วิธีจองห้อง</a></li>
                <li><a href="rules.php">กฎระเบียบ</a></li>
                <li><a href="my_bookings.php">การจองของท่าน</a></li>
                <li><a href="booking_calendar.php">ปฏิทิน</a></li>
            </ul>
        </nav>
    </header>

    <section class="room-detail">
        <div class="container">
            <h2 class="title">รายละเอียด <?php echo $room["name"]; ?></h2>
            <div class="content-grid">
                <div class="left">
                    <div class="calendar-container">
                        <h3>เลือกวันที่</h3>
                        <input type="text" id="calendar" class="calendar-input" readonly>
                    </div>

                    <div class="time-selection">
                        <h3>เลือกช่วงเวลา</h3>
                        <select name="time_slot" id="time_slot" class="dropdown" required>
                            <option value="">-- กรุณาเลือกวันที่ก่อน --</option>
                        </select>
                    </div>

                    <!-- ปุ่มจองห้อง -->
                    <button id="openBookingModal" class="btn book-room">จองห้อง</button>
                </div>

                <div class="right">
                    <div class="room-image">
                        <img src="/software/images/<?php echo $room["image"]; ?>" alt="<?php echo $room["name"]; ?>">
                    </div>
                </div>
            </div>

            <div class="room-info">
                <h3>ข้อมูลห้องประชุม</h3>
                <p><strong>ขนาด:</strong> <?php echo $room["size"]; ?></p>
                <p><strong>อุปกรณ์:</strong> <?php echo $room["equipment"]; ?></p>
            </div>
        </div>
    </section>

    <!-- Modal ฟอร์มจองห้อง -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">จองห้องประชุม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" action="booking_process.php" method="POST">
                        <input type="hidden" name="room_id" value="<?php echo $room_id; ?>">
                        <input type="hidden" name="selected_date" id="selected_date">
                        <input type="hidden" name="selected_time" id="selected_time">

                        <div class="mb-3">
                            <label>ชื่อผู้จอง</label>
                            <input type="text" name="customer_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>เบอร์โทร</label>
                            <input type="text" name="customer_phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>หน่วยงาน</label>
                            <input type="text" name="customer_department" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">ยืนยันการจอง</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer fade-in">
        <p>ติดต่อสอบถามเพิ่มเติม: admin@nont-pro.go.th</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            flatpickr("#calendar", {
                inline: true,
                dateFormat: "Y-m-d",
                minDate: "today",
                locale: "th",
                onChange: function(selectedDates, dateStr) {
                    document.getElementById("selected_date").value = dateStr;
                    fetchBookedTimes(dateStr);
                }
            });

            function fetchBookedTimes(date) {
                fetch("fetch_booked_times.php?room_id=<?php echo $room_id; ?>&date=" + date)
                    .then(response => response.json())
                    .then(data => {
                        const timeSlotSelect = document.getElementById("time_slot");
                        timeSlotSelect.innerHTML = "<option value=''>-- เลือกช่วงเวลา --</option>";
                        
                        data.time_slots.forEach(slot => {
                            let option = document.createElement("option");
                            option.value = slot;
                            option.textContent = slot + (data.booked_times.includes(slot) ? " (จองแล้ว)" : "");
                            if (data.booked_times.includes(slot)) {
                                option.disabled = true;
                            }
                            timeSlotSelect.appendChild(option);
                        });
                    });
            }

            document.getElementById("openBookingModal").addEventListener("click", function (event) {
                const selectedDate = document.getElementById("selected_date").value;
                const selectedTime = document.getElementById("time_slot").value;
                
                if (!selectedDate || !selectedTime) {
                    alert("กรุณาเลือกวันที่และช่วงเวลาก่อนทำการจอง!");
                    event.preventDefault();
                } else {
                    document.getElementById("selected_time").value = selectedTime;
                    new bootstrap.Modal(document.getElementById("bookingModal")).show();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
