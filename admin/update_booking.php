<?php
include __DIR__ . '/../config/config.php';

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST['id'], $_POST['customer_name'], $_POST['customer_phone'], $_POST['booking_date'], $_POST['time_slot'])) {
        echo json_encode(["status" => "error", "message" => "❌ ข้อมูลไม่ครบ"]);
        exit();
    }

    $id = intval($_POST['id']);
    $customer_name = $_POST['customer_name'];
    $customer_phone = $_POST['customer_phone'];
    $booking_date = $_POST['booking_date'];
    $time_slot = $_POST['time_slot'];

    // ตรวจสอบว่า ID มีอยู่จริง
    $check_sql = "SELECT id FROM bookings WHERE id = ?";
    $stmt_check = $conn->prepare($check_sql);
    $stmt_check->bind_param("i", $id);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "❌ ไม่พบการจองนี้"]);
        exit();
    }

    // อัปเดตข้อมูล
    $sql = "UPDATE bookings SET customer_name=?, customer_phone=?, booking_date=?, time_slot=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $customer_name, $customer_phone, $booking_date, $time_slot, $id);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "✅ แก้ไขข้อมูลสำเร็จ"]);
    } else {
        echo json_encode(["status" => "error", "message" => "❌ ไม่สามารถแก้ไขข้อมูลได้"]);
    }
}
?>
