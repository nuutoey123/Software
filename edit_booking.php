<?php
include 'config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $sql = "UPDATE bookings SET customer_name = ?, customer_phone = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $customer_name, $customer_phone, $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('อัปเดตข้อมูลสำเร็จ'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('อัปเดตล้มเหลว'); window.location='admin.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลการจอง</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center text-primary">✏️ แก้ไขข้อมูลการจอง</h2>
        <div class="card shadow p-4 mt-4">
            <form method="POST">
                <div class="mb-3">
                    <label class="form-label">📌 ห้องประชุม:</label>
                    <input type="text" class="form-control" value="<?= $booking['room_id']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">📅 วันที่จอง:</label>
                    <input type="text" class="form-control" value="<?= $booking['booking_date']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">⏰ ช่วงเวลา:</label>
                    <input type="text" class="form-control" value="<?= $booking['time_slot']; ?>" disabled>
                </div>
                <div class="mb-3">
                    <label class="form-label">👤 ชื่อผู้จอง:</label>
                    <input type="text" name="customer_name" class="form-control" value="<?= $booking['customer_name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">📞 เบอร์โทรศัพท์:</label>
                    <input type="text" name="customer_phone" class="form-control" value="<?= $booking['customer_phone']; ?>" required>
                </div>
                <div class="d-flex justify-content-between">
                    <a href="admin.php" class="btn btn-secondary">⬅️ กลับ</a>
                    <button type="submit" name="update" class="btn btn-success">💾 บันทึกการเปลี่ยนแปลง</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
