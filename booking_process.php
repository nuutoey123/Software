<?php
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $customer_name = $_POST["customer_name"];
    $customer_phone = $_POST["customer_phone"];
    $selected_date = $_POST["selected_date"];
    $selected_time = $_POST["selected_time"];
    $sub_department_id = $_POST["sub_department_id"];
    $meeting_topic = $_POST["meeting_topic"];
    $meeting_detail = $_POST["meeting_detail"];

    $stmt = $conn->prepare("INSERT INTO bookings 
        (room_id, customer_name, customer_phone, booking_date, time_slot, sub_department_id, meeting_topic, meeting_detail) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("issssiss", $room_id, $customer_name, $customer_phone, $selected_date, $selected_time, $sub_department_id, $meeting_topic, $meeting_detail);

    if ($stmt->execute()) {
        echo "<script>alert('จองห้องสำเร็จ!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "');</script>";
    }
}

?>