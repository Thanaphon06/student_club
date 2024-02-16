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
    $s_id = $_POST['s_id'];
    $s_name = $_POST['s_name'];

    // อัปเดตข้อมูลในฐานข้อมูล
    $stmt = $conn->prepare("UPDATE students SET s_id = :s_id, s_name = :s_name WHERE s_id = :id");
    $stmt->bindParam(':s_id', $s_id);
    $stmt->bindParam(':s_name', $s_name);
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
                window.location.href = 'index.php';
            }, 3000); // 3 วินาที
          </script>";
}
?>
