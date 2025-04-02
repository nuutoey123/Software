<?php
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $customer_name = $_POST["customer_name"];
    $customer_phone = $_POST["customer_phone"];
    $selected_date = $_POST["selected_date"];
    $selected_time = $_POST["selected_time"];
    $sub_department_id = $_POST["sub_department_id"];
    $department_id = $_POST["department_id"];

    // เตรียมคำสั่ง SQL ให้ใส่ department_id และ sub_department_id ด้วย
    $stmt = $conn->prepare("INSERT INTO bookings 
    (room_id, customer_name, customer_phone, booking_date, time_slot, department_id, sub_department_id) 
    VALUES (?, ?, ?, ?, ?, ?, ?)");
    
    $stmt->bind_param("issssii", 
        $room_id, 
        $customer_name, 
        $customer_phone, 
        $selected_date, 
        $selected_time, 
        $department_id, 
        $sub_department_id
    );


    if ($stmt->execute()) {
        echo "<script>alert('จองห้องสำเร็จ!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด: " . $stmt->error . "');</script>";
    }
}
?>
