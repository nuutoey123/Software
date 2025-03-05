<?php
$servername = "localhost";
$username = "root"; // เปลี่ยนเป็นชื่อผู้ใช้จริง
$password = "12345678"; // ใส่รหัสผ่านของ MySQL
$dbname = "meeting_db";

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
