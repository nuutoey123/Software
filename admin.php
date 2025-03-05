<?php 
include 'config/config.php'; // ไฟล์เชื่อมต่อฐานข้อมูล

// ดึงข้อมูลการจองทั้งหมด
$sql = "SELECT b.id, b.booking_date, b.time_slot, b.customer_name, b.customer_phone, r.name AS room_name 
        FROM bookings b 
        JOIN rooms r ON b.room_id = r.id 
        ORDER BY b.booking_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ระบบจัดการการจอง</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        .table th {
            background: #2c3e50;
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn-back {
            margin-bottom: 20px;
            background-color: #3498db;
            color: white;
        }
        .btn-back:hover {
            background-color: #2980b9;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📌 ระบบจัดการการจอง</h2>
        
        <!-- ปุ่มกลับไปหน้าแรก -->
        <a href="index.php" class="btn btn-back btn-sm">⬅ กลับไปหน้าแรก</a>

        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ห้องประชุม</th>
                    <th>วันที่</th>
                    <th>ช่วงเวลา</th>
                    <th>ผู้จอง</th>
                    <th>เบอร์โทร</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['room_name']; ?></td>
                        <td><?= $row['booking_date']; ?></td>
                        <td><?= $row['time_slot']; ?></td>
                        <td><?= $row['customer_name']; ?></td>
                        <td><?= $row['customer_phone']; ?></td>
                        <td>
                            <a href="edit_booking.php?id=<?= $row['id']; ?>" class="btn btn-warning btn-sm">✏ แก้ไข</a>
                            <a href="delete_booking.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?');">🗑 ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
