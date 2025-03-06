<?php
include __DIR__ . '/../config/config.php';

if (isset($_GET['id'])) {
    $booking_id = intval($_GET['id']); // ป้องกัน SQL Injection

    // ลบข้อมูล
    $sql = "DELETE FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $booking_id);

    if ($stmt->execute()) {
        echo "<script>alert('✅ ลบข้อมูลสำเร็จ!'); window.location.href = 'admin_dashboard.php';</script>";
    } else {
        echo "<script>alert('❌ เกิดข้อผิดพลาด! ไม่สามารถลบข้อมูลได้'); window.location.href = 'admin_dashboard.php';</script>";
    }
} else {
    echo "<script>alert('⚠ ไม่พบข้อมูลที่ต้องการลบ!'); window.location.href = 'admin_dashboard.php';</script>";
}
?>
