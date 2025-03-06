<?php
include 'config/config.php';

$room_id = $_GET['room_id'];
$date = $_GET['date'];

// ดึงเวลาที่จองแล้ว
$booked_times = [];
$sql = "SELECT time_slot FROM bookings WHERE room_id = ? AND booking_date = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $room_id, $date);
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $booked_times[] = $row["time_slot"];
}
$stmt->close();

// ดึงทุกช่วงเวลา
$time_slots = [];
$result = $conn->query("SELECT time_range FROM time_slots");
while ($row = $result->fetch_assoc()) {
    $time_slots[] = $row["time_range"];
}

echo json_encode(["booked_times" => $booked_times, "time_slots" => $time_slots]);
?>
