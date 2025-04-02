<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บริการจองห้องประชุม</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/software/css/style-rules.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.8/main.min.css">
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css" rel="stylesheet">
    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let lastScrollTop = 0;
            const navbar = document.querySelector("header");
            window.addEventListener("scroll", function () {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > 50) {
                    navbar.style.top = "-80px";
                } else {
                    navbar.style.top = "0";
                }
                lastScrollTop = scrollTop;
            });

            const fadeInElements = document.querySelectorAll(".fade-in");
            const observer = new IntersectionObserver(entries => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add("show");
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.15 });
            fadeInElements.forEach(element => observer.observe(element));
        });

        function scrollToTop() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // ดึงข้อมูลการจองมาแสดงในปฏิทิน
        document.addEventListener("DOMContentLoaded", function () {
            var calendarEl = document.getElementById("calendar");

            if (calendarEl) {
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: "dayGridMonth",
                    events: "fetch_bookings.php",  // ดึงข้อมูลจากไฟล์นี้
                    eventClick: function (info) {
                        console.log(info.event.extendedProps); // ตรวจสอบค่าที่ถูกส่งมา

                        // เพิ่มข้อมูลลงใน modal
                        $("#roomName").text(info.event.extendedProps.roomName || "ไม่มีข้อมูล");
                        $("#bookingDate").text(info.event.start.toISOString().split('T')[0] || "ไม่มีข้อมูล");
                        $("#bookingTime").text(info.event.extendedProps.bookingTime || "ไม่มีข้อมูล");
                        $("#customerName").text(info.event.extendedProps.customerName || "ไม่มีข้อมูล");
                        $("#customerPhone").text(info.event.extendedProps.customerPhone || "ไม่มีข้อมูล");
                        $("#department").text(info.event.extendedProps.department || "ไม่มีข้อมูล");
                        $("#meetingTopic").text(info.event.extendedProps.meetingTopic || "ไม่มีข้อมูล");
                        $("#meetingDetail").text(info.event.extendedProps.meetingDetail || "ไม่มีข้อมูล");

                        // แสดง modal
                        $("#bookingModal").modal("show");
                    }
                });
                calendar.render();
            } else {
                console.error("❌ ไม่พบ element #calendar ในหน้าเว็บ!");
            }
        });
    </script>
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

    <button id="goTop" class="go-top" onclick="scrollToTop()">▲</button>

    <section class="hero fade-in">
        <div class="overlay"></div>
    </section>

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
                    <p><strong>หัวข้อการประชุม:</strong> <span id="meetingTopic"></span></p>
                    <p><strong>รายละเอียดการประชุม:</strong> <span id="meetingDetail"></span></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <br>
    <footer class="footer fade-in">
        <div class="contact-info">
            <h3>ติดต่อสอบถามเพิ่มเติม</h3>
            <p><strong>องค์การบริหารส่วนจังหวัดนนทบุรี</strong></p>
            <p>NONTABURI PROVINCIAL ADMINISTRATIVE ORGANIZATION</p>
            <p>ถนนรัตนาธิเบศร์ 6 ตำบลบางกระสอ อำเภอเมืองนนทบุรี จังหวัดนนทบุรี 11000</p>
        </div>
        <div class="contact-details">
            <p><strong>โทรศัพท์:</strong> 02-589-0481-5</p>
            <p><strong>โทรสาร:</strong> 0-2591-6929</p>
            <p><strong>Email:</strong> admin@nont-pro.go.th</p>
        </div>
    </footer>
</body>


</html>
