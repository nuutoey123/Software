<?php
include 'config/config.php';

// ดึงข้อมูลการจอง **ตั้งแต่วันนี้เป็นต้นไป**
$sql = "SELECT 
            b.id, b.booking_date, b.time_slot, b.customer_name, b.customer_phone,
            b.meeting_topic, b.meeting_detail,
            r.name AS room_name, r.image,
            sd.name AS sub_department_name, d.name AS department_name
        FROM bookings b
        JOIN rooms r ON b.room_id = r.id
        LEFT JOIN sub_departments sd ON b.sub_department_id = sd.id
        LEFT JOIN departments d ON sd.department_id = d.id
        WHERE b.booking_date >= CURDATE()
        ORDER BY b.booking_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การจองของท่าน</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/software/css/style-mybooking.css" />
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

    <section class="bookings-section fade-in">
        <h2 class="title">การจองของท่าน</h2>
        <p>พบกับบริการจองห้องประชุมออนไลน์ที่สะดวกและรวดเร็วที่สุด ไม่ว่าคุณจะอยู่ที่ไหน
            <br />ก็สามารถเลือกดูและจองห้องประชุมที่ตรงกับความต้องการของคุณได้อย่างง่ายดาย
        </p>
        <hr>

        <div class="bookings-container">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) { ?>
                    <div class="booking-card">
                        <?php
                        $firstImage = explode(',', $row['image'])[0]; // ดึงรูปแรก
                        ?>
                        <img src="/software/images/<?php echo trim($firstImage); ?>" alt="<?php echo $row['room_name']; ?>">
                        <div class="card-info">
                            <h3><?php echo $row['room_name']; ?></h3>
                            <p><strong>วันที่:</strong> <?php echo $row['booking_date']; ?></p>
                            <p><strong>ช่วงเวลา:</strong> <?php echo $row['time_slot']; ?></p>
                            <p><strong>ผู้จอง:</strong> <?php echo $row['customer_name']; ?></p>
                            <p><strong>เบอร์โทร:</strong> <?php echo $row['customer_phone']; ?></p>
                            <p><strong>หัวข้อการประชุม:</strong> <?php echo $row['meeting_topic']; ?></p>
                            <p><strong>รายละเอียด:</strong> <?php echo nl2br($row['meeting_detail']); ?></p>
                            <p><strong>หน่วยงาน:</strong>
                                <?php echo $row['department_name'] . ' - ' . $row['sub_department_name']; ?></p>
                            <p><strong>หัวข้อการประชุม:</strong> <?php echo $row['meeting_topic']; ?></p>
                            <p><strong>รายละเอียด:</strong> <?php echo nl2br($row['meeting_detail']); ?></p>
                        </div>
                    </div>
                <?php }
            } else {
                echo "<p style='text-align:center;'>❌ ไม่มีการจองที่ยังไม่หมดเวลา</p>";
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