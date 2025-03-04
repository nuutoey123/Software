<?php
include 'config/config.php';
header('Content-Type: application/json');

$sql = "SELECT bookings.*, rooms.name AS roomName FROM bookings 
        INNER JOIN rooms ON bookings.room_id = rooms.id";
$result = $conn->query($sql);

$events = [];

while ($row = $result->fetch_assoc()) {
    $events[] = [
        "id" => $row["id"], 
        "title" => $row["roomName"] . " (" . $row["time_slot"] . ")",
        "start" => $row["booking_date"],
        "extendedProps" => [
            "roomName" => $row["roomName"] ?? "ไม่มีข้อมูล",
            "bookingTime" => $row["time_slot"] ?? "ไม่มีข้อมูล",
            "customerName" => $row["customer_name"] ?? "ไม่มีข้อมูล",
            "customerPhone" => $row["customer_phone"] ?? "ไม่มีข้อมูล",
            "department" => $row["customer_department"] ?? "ไม่มีข้อมูล"
        ]
    ];
}

echo json_encode($events);
?>
