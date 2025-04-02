<?php include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บริการจองห้องประชุม</title>
    <link rel="stylesheet" href="/software/css/style-booking.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let lastScrollTop = 0;
            const navbar = document.querySelector("header");
            const goTopButton = document.getElementById("goTop");

            window.addEventListener("scroll", function () {
                let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                if (scrollTop > 50) {
                    navbar.style.top = "-80px";
                    goTopButton.classList.add("show");
                } else {
                    navbar.style.top = "0";
                    goTopButton.classList.remove("show");
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

    <section class="room-container fade-in">
        <h2 style="color: #486284; font-size: 50px; margin-bottom: 30px;">ห้องประชุม</h2>
        <p style="margin-bottom: 60px;">พบกับบริการจองห้องประชุมออนไลน์ที่สะดวกและรวดเร็วที่สุด ไม่ว่าคุณจะอยู่ที่ไหน
            <br> ก็สามารถเลือกดูและจองห้องประชุมที่ตรงกับความต้องการของคุณได้อย่างง่ายดาย
        </p>
        <hr style="margin-bottom: 20px; color: #90A3BF;">
        <div class="room-grid">
            <?php
            $sql = "SELECT * FROM rooms";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="room-card">';
                    $firstImage = explode(',', $row["image"])[0]; // ดึงรูปแรกจาก image
                    echo '<img src="/software/images/' . trim($firstImage) . '" alt="' . $row["name"] . '">';
                    echo '<h3>' . $row["name"] . '</h3>';
                    echo '<a href="room_detail.php?id=' . $row["id"] . '" class="details-btn">รายละเอียด</a>';
                    echo '</div>';
                }
            } else {
                echo "ไม่มีห้องประชุมที่พร้อมใช้งาน";
            }
            ?>
        </div>
    </section>

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