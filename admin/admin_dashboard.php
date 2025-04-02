<?php 
session_start();
include __DIR__ . '/../config/config.php';  

// ตรวจสอบว่าผู้ใช้ Login หรือยัง
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php"); // Redirect ไปหน้า Login
    exit();
}

// ดึงข้อมูลการจองทั้งหมด
$sql = "SELECT b.id, b.booking_date, b.time_slot, b.customer_name, b.customer_phone, r.name AS room_name 
        FROM bookings b 
        JOIN rooms r ON b.room_id = r.id 
        ORDER BY b.booking_date DESC";
$result = $conn->query($sql);

// ดึงรายการช่วงเวลาที่มีอยู่
$time_slots_sql = "SELECT time_range FROM time_slots ORDER BY time_range ASC";
$time_slots_result = $conn->query($time_slots_sql);
$time_slots = [];
while ($row = $time_slots_result->fetch_assoc()) {
    $time_slots[] = $row["time_range"];
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ระบบจัดการการจอง</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 20px;
        }
        .table th {
            background: #2c3e50;
            color: white;
            text-align: center;
        }
        .table td {
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>📌 ระบบจัดการการจอง</h2>
        <table class="table table-striped mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ห้องประชุม</th>
                    <th>วันที่</th>
                    <th>ช่วงเวลา</th>
                    <th>ผู้จอง</th>
                    <th>เบอร์โทร</th>
                    <th>การจัดการ</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id']; ?></td>
                        <td><?= $row['room_name']; ?></td>
                        <td><?= $row['booking_date']; ?></td>
                        <td><?= $row['time_slot']; ?></td>
                        <td><?= $row['customer_name']; ?></td>
                        <td><?= $row['customer_phone']; ?></td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-btn" 
                                data-id="<?= $row['id']; ?>" 
                                data-room="<?= $row['room_name']; ?>"
                                data-date="<?= $row['booking_date']; ?>"
                                data-time="<?= $row['time_slot']; ?>"
                                data-name="<?= $row['customer_name']; ?>"
                                data-phone="<?= $row['customer_phone']; ?>"
                                data-bs-toggle="modal" data-bs-target="#editModal">
                                ✏ แก้ไข
                            </button>
                            <a href="delete_booking.php?id=<?= $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('ยืนยันการลบ?');">🗑 ลบ</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="admin_logout.php" class="btn btn-danger">ออกจากระบบ</a>
    </div>

    <!-- Modal แก้ไขข้อมูล -->
    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">📝 แก้ไขข้อมูลการจอง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm">
                        <input type="hidden" name="id" id="edit_id">
                        <div class="mb-3">
                            <label>ชื่อผู้จอง</label>
                            <input type="text" name="customer_name" id="edit_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>เบอร์โทร</label>
                            <input type="text" name="customer_phone" id="edit_phone" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>วันที่จอง</label>
                            <input type="date" name="booking_date" id="edit_date" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label>ช่วงเวลา</label>
                            <select name="time_slot" id="edit_time" class="form-control">
                                <option value="">-- เลือกช่วงเวลา --</option>
                                <?php foreach ($time_slots as $slot) { ?>
                                    <option value="<?= $slot; ?>"><?= $slot; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">บันทึก</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $(".edit-btn").click(function(){
                $("#edit_id").val($(this).data("id"));
                $("#edit_name").val($(this).data("name"));
                $("#edit_phone").val($(this).data("phone"));
                $("#edit_date").val($(this).data("date"));
                $("#edit_time").val($(this).data("time"));
            });

            $("#editForm").submit(function(e){
                e.preventDefault();
                $.ajax({
                    url: "update_booking.php", // ✅ แก้พาธให้ถูกต้อง
                    type: "POST",
                    data: $("#editForm").serialize(),
                    dataType: "json",
                    success: function(response){
                        if (response.status === "success") {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(){
                        alert("❌ เกิดข้อผิดพลาด! ไม่สามารถเชื่อมต่อกับเซิร์ฟเวอร์ได้");
                    }
                });
            });
        });
    </script>

</body>
</html>
