<?php
include 'config/config.php';

$sql = "SELECT bookings.booking_date, bookings.time_slot, rooms.name AS room_name, bookings.customer_name 
        FROM bookings 
        JOIN rooms ON bookings.room_id = rooms.id";

$result = $conn->query($sql);
$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            "title" => "🛋️ " . $row["room_name"] . " | ⏰ " . $row["time_slot"] . " | 👤 " . $row["customer_name"],
            "start" => $row["booking_date"],
            "color" => "#007bff"
        ];
    }
}
echo json_encode($events);
?>
