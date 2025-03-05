<?php
include 'config/config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "<script>alert('ลบข้อมูลสำเร็จ'); window.location='admin.php';</script>";
    } else {
        echo "<script>alert('ลบข้อมูลล้มเหลว'); window.location='admin.php';</script>";
    }
}
?>
