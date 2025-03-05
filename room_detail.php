<?php include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดห้องประชุม</title>
    <link rel="stylesheet" href="/software/css/style-detail.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Flatpickr JS -->
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

    <?php
    if (isset($_GET['id'])) {
        $room_id = $_GET['id'];
        $sql = "SELECT * FROM rooms WHERE id = $room_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $room = $result->fetch_assoc();
        } else {
            echo "<p>ไม่พบข้อมูลห้องประชุม</p>";
            exit();
        }
    } else {
        echo "<p>ไม่มีข้อมูลห้องที่เลือก</p>";
        exit();
    }

    // ดึงข้อมูลช่วงเวลาจากฐานข้อมูล
    $time_sql = "SELECT * FROM time_slots";
    $time_result = $conn->query($time_sql);
    ?>

    <section class="room-detail">
        <div class="container">
            <h2 class="title">รายละเอียด <?php echo $room["name"]; ?></h2>
            <div class="content-grid">
                <!-- ฝั่งซ้าย: ปฏิทิน และ เลือกช่วงเวลา -->
                <div class="left">
                    <div class="calendar-container">
                        <h3>เลือกวันที่</h3>
                        <input type="text" id="calendar" class="calendar-input" readonly>
                    </div>

                    <div class="time-selection">
                        <h3>เลือกช่วงเวลา</h3>
                        <select name="time_slot" id="time_slot" class="dropdown" required>
                            <option value="">-- เลือกช่วงเวลา --</option>
                            <?php
                            if ($time_result->num_rows > 0) {
                                while ($row = $time_result->fetch_assoc()) {
                                    echo "<option value='" . $row["time_range"] . "'>" . $row["time_range"] . "</option>";
                                }
                            } else {
                                echo "<option value=''>ไม่มีช่วงเวลาที่ใช้ได้</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <!-- ปุ่มกดเปิด Modal -->
                    <button class="btn book-room" data-bs-toggle="modal" data-bs-target="#bookingModal">จองห้อง</button>
                </div>

                <!-- ฝั่งขวา: รูปภาพห้อง -->
                <div class="right">
                    <div class="room-image">
                        <img src="/software/images/<?php echo $room["image"]; ?>" alt="<?php echo $room["name"]; ?>">
                    </div>
                </div>
            </div>

            <!-- รายละเอียดห้อง -->
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
                    <form action="booking_process.php" method="POST">
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
                locale: "th"
            });

            document.querySelector(".book-room").addEventListener("click", function () {
                document.getElementById("selected_date").value = document.getElementById("calendar").value;
                document.getElementById("selected_time").value = document.getElementById("time_slot").value;
            });
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>