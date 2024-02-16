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
    $c_name = $_POST['c_name'];

    // สร้างคำสั่ง SQL เพื่อแทรกข้อมูล
    $sql = "INSERT INTO club (c_id, c_name) VALUES ('$c_id', '$c_name')";
    
    // ส่งคำสั่ง SQL ไปทำการ execute
    $conn->exec($sql);
    
    echo "เพิ่มชมรมเรียบร้อยแล้ว";
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $e->getMessage();
}

$conn = null;


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