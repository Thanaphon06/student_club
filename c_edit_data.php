<?php
// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับค่าที่ส่งมาจากฟอร์มแก้ไขข้อมูล
    $id = $_POST['id'];
    $c_id = $_POST['c_id'];
    $c_name = $_POST['c_name'];

    // อัปเดตข้อมูลในฐานข้อมูล
    $stmt = $conn->prepare("UPDATE club SET c_id = :c_id, c_name = :c_name WHERE c_id = :id");
    $stmt->bindParam(':c_id', $c_id);
    $stmt->bindParam(':c_name', $c_name);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "แก้ไขข้อมูลเรียบร้อยแล้ว";
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการแก้ไขข้อมูล: " . $e->getMessage();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // โค้ดสำหรับ insert ข้อมูลลงในฐานข้อมูล

    // เมื่อ insert เสร็จสมบูรณ์ ให้ redirect ไปยังหน้า index หลักหลังจาก 5 วินาที
    echo "<script>
            setTimeout(function() {
                window.location.href = 'index_root.php';
            }, 3000); // 3 วินาที
          </script>";
}
?>
