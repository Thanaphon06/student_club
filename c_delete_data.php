<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูลจากฟอร์ม
    $c_id = $_POST['c_id'];
    

    // สร้างคำสั่ง SQL เพื่อแทรกข้อมูล
    $sql = "DELETE FROM club WHERE c_id = ($c_id)";
    
    // ส่งคำสั่ง SQL ไปทำการ execute
    $conn->exec($sql);
    
    echo "ลบข้อมูลสำเร็จ";
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $e->getMessage();
}

$conn = null;


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