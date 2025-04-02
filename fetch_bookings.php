<?php
include 'config/config.php';
header('Content-Type: application/json');

// JOIN ข้อมูลหน่วยงานหลักและย่อย
$sql = "SELECT b.*, r.name AS roomName, d.name AS department_name, sd.name AS sub_department_name 
        FROM bookings b
        INNER JOIN rooms r ON b.room_id = r.id
        LEFT JOIN sub_departments sd ON b.sub_department_id = sd.id
        LEFT JOIN departments d ON sd.department_id = d.id";

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
            "department" => ($row["department_name"] ?? "") . " - " . ($row["sub_department_name"] ?? "ไม่มีข้อมูล")
        ]
    ];
}

echo json_encode($events);
