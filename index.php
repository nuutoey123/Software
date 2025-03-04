<?php include 'config/config.php'; ?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บริการจองห้องประชุม</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/software/css/style-index.css"/>
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
                <li><a href="#">วิธีจองห้อง</a></li>
                <li><a href="#">กฎระเบียบ</a></li>
                <li><a href="#">การจองของท่าน</a></li>
            </ul>
        </nav>
    </header>
    <button id="goTop" class="go-top" onclick="scrollToTop()">▲</button>
    <section class="hero fade-in">
        <div class="overlay"></div>
        <div class="content">
            <h2>"ค้นหาและจองห้องประชุมที่ใช่ ได้อย่างรวดเร็ว"</h2>
            <h1 class="textHeader">บริการจองห้องประชุม</h1>
            <button class="btn">จองห้อง</button>
        </div>
    </section>
    <h2 class="section-title fade-in">"ให้การประชุมของคุณเป็นเรื่องง่าย
        ด้วยบริการจองห้องประชุมออนไลน์ที่สะดวกและรวดเร็ว"</h2>
    <section class="section fade-in">
        <div class="text">
            <h2>รูปแบบ <span style="color: #3f51b5;">ห้องประชุม</span></h2>
            <p>"การประชุมที่ดีไม่ได้อยู่ที่เนื้อหาเพียงอย่างเดียว แต่บรรยากาศของห้องประชุมก็มีส่วนสำคัญ
                บางทีห้องประชุมแบบไหนก็จะช่วยให้การประชุมของคุณราบรื่นและมีประสิทธิภาพมากยิ่งขึ้น"</p>
            <a href="#" class="btn-more">ดูเพิ่มเติม</a>
        </div>
        <div class="image-gallery">
            <img src="/software/images/meeting1.jpg" alt="Meeting Room 1" class="fade-in">
            <img src="/software/images/meeting2.jpg" alt="Meeting Room 2" class="fade-in">
            <img src="/software/images/meeting3.jpg" alt="Meeting Room 3" class="fade-in">
            <img src="/software/images/meeting4.jpg" alt="Meeting Room 4" class="fade-in">
        </div>
    </section>
    <section class="rules-section fade-in">
        <div class="rules-text">
            <h2>กฎระเบียบการใช้ห้องประชุม</h2>
            <ul>
                <li>กรุณาจองห้องประชุมล่วงหน้าผ่านระบบออนไลน์ หรือ ติดต่อเจ้าหน้าที่</li>
                <li>กรุณาตรงต่อเวลา หากมาสายเกิน 15 นาที ถือว่าสละสิทธิ์การจอง</li>
                <li>อนุญาตให้ใช้ห้องประชุมเพื่อการประชุม สัมมนา หรือกิจกรรมที่เกี่ยวข้องเท่านั้น</li>
                <li>ห้ามนำอาหารและเครื่องดื่มเข้าไปในห้องประชุม</li>
                <li>ห้ามสูบบุหรี่ในห้องประชุม</li>
                <li>กรุณาดูแลรักษาความสะอาดและความเป็นระเบียบเรียบร้อยของห้องประชุม</li>
                <li>กรุณาใช้อุปกรณ์และสิ่งอำนวยความสะดวกต่างๆ อย่างระมัดระวัง</li>
                <li>หากอุปกรณ์หรือสิ่งอำนวยความสะดวกใดๆ เสียหาย กรุณาแจ้งเจ้าหน้าที่</li>
                <li>ผู้ใช้ห้องประชุมต้องรับผิดชอบต่อความเสียหายที่เกิดขึ้นกับห้องประชุม อุปกรณ์
                    และสิ่งอำนวยความสะดวกต่างๆ</li>
                <li>กรุณาออกจากห้องประชุมตรงเวลา และจัดเก็บอุปกรณ์และสิ่งของต่างๆ ให้เรียบร้อย</li>
            </ul>
        </div>
        <div class="rules-image">
            <img src="images/rules-image.jpg" alt="กฎระเบียบการใช้ห้องประชุม">
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
