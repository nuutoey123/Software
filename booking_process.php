<?php
include 'config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST["room_id"];
    $customer_name = $_POST["customer_name"];
    $customer_phone = $_POST["customer_phone"];
    $customer_department = $_POST["customer_department"];
    $selected_date = $_POST["selected_date"];
    $selected_time = $_POST["selected_time"];

    $sql = "INSERT INTO bookings (room_id, customer_name, customer_phone, customer_department, booking_date, time_slot)
            VALUES ('$room_id', '$customer_name', '$customer_phone', '$customer_department', '$selected_date', '$selected_time')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('จองห้องสำเร็จ!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>