<?php include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ปฏิทินการจอง</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/main.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    <header class="fade-in">
        <nav class="navbar navbar-light bg-white px-3">
            <a class="navbar-brand" href="#">
                <img src="/software/images/logo.png" width="50" alt="logo">
            </a>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">หน้าหลัก</a></li>
                <li class="nav-item"><a class="nav-link" href="booking.php">จองห้อง</a></li>
                <li class="nav-item"><a class="nav-link" href="#">วิธีจองห้อง</a></li>
                <li class="nav-item"><a class="nav-link" href="#">กฎระเบียบ</a></li>
                <li class="nav-item"><a class="nav-link" href="booking_calendar.php">ปฏิทิน</a></li>
            </ul>
        </nav>
    </header>

    <div class="container mt-4">
        <h2 class="text-primary">📅 ปฏิทินการจองห้องประชุม</h2>
        <div class="row">
            <!-- ปฏิทิน -->
            <div class="col-md-12">
                <div class="card shadow p-3">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal แสดงรายละเอียดการจอง -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">รายละเอียดการจอง</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ห้องประชุม:</strong> <span id="roomName"></span></p>
                <p><strong>วันที่:</strong> <span id="bookingDate"></span></p>
                <p><strong>ช่วงเวลา:</strong> <span id="bookingTime"></span></p>
                <p><strong>ผู้จอง:</strong> <span id="customerName"></span></p>
                <p><strong>เบอร์โทร:</strong> <span id="customerPhone"></span></p>
                <p><strong>หน่วยงาน:</strong> <span id="department"></span></p>
            </div>
        </div>
    </div>
</div>

    <footer class="footer mt-5 p-3 text-center bg-white">
        <p>© 2025 NONTABURI PROVINCIAL ADMINISTRATIVE ORGANIZATION</p>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    var calendarEl = document.getElementById("calendar");

    if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: "dayGridMonth",
            events: "fetch_bookings.php",
            eventClick: function (info) {
                console.log(info.event.extendedProps); // ตรวจสอบค่าที่ถูกส่งมา
                
                $("#roomName").text(info.event.extendedProps.roomName || "ไม่มีข้อมูล");
                $("#bookingDate").text(info.event.start.toISOString().split('T')[0] || "ไม่มีข้อมูล");
                $("#bookingTime").text(info.event.extendedProps.bookingTime || "ไม่มีข้อมูล");
                $("#customerName").text(info.event.extendedProps.customerName || "ไม่มีข้อมูล");
                $("#customerPhone").text(info.event.extendedProps.customerPhone || "ไม่มีข้อมูล");
                $("#department").text(info.event.extendedProps.department || "ไม่มีข้อมูล");

                $("#bookingModal").modal("show");
            }
        });
        calendar.render();
    } else {
        console.error("❌ ไม่พบ element #calendar ในหน้าเว็บ!");
    }
});

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
