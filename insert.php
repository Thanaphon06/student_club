<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // รับข้อมูลจากฟอร์ม
    $s_id = $_POST['s_id'];
    $s_name = $_POST['s_name'];

    // สร้างคำสั่ง SQL เพื่อแทรกข้อมูลลงในตาราง students
    $sql_students = "INSERT INTO students (s_id, s_name) VALUES ('$s_id', '$s_name')";
    
    // ส่งคำสั่ง SQL ไปทำการ execute เพื่อเพิ่มข้อมูลในตาราง students
    $conn->exec($sql_students);
    $random_c_id = rand(1, 5);
    // เพิ่มข้อมูลลงในตาราง memberclub ด้วย s_id ที่เพิ่มลงในตาราง students
    $sql_memberclub = "INSERT INTO memberclub (s_id, c_id) VALUES ('$s_id', '$random_c_id')";
    $conn->exec($sql_memberclub);
    
    echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการเพิ่มข้อมูล: " . $e->getMessage();
}

$conn = null;

// Redirect ไปยังหน้า index หลักหลังจากเพิ่มข้อมูลเสร็จสมบูรณ์
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo "<script>
            setTimeout(function() {
                window.location.href = 'index_root.php';
            }, 3000); // 3 วินาที
          </script>";
}
?>
