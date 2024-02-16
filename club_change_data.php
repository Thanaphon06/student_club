<?php
// Include your database connection file here

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['s_id']) && isset($_POST['c_id'])) {
        $s_id = $_POST['s_id'];
        $c_id = $_POST['c_id'];

        // Update the club associated with the provided s_id
        $stmt = $conn->prepare("UPDATE memberclub SET c_id = :c_id WHERE s_id = :s_id");
        $stmt->bindParam(':c_id', $c_id);
        $stmt->bindParam(':s_id', $s_id);
        $stmt->execute();

        echo "Club updated successfully.";
    } else {
        echo "Invalid request.";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // โค้ดสำหรับ insert ข้อมูลลงในฐานข้อมูล

    // เมื่อ insert เสร็จสมบูรณ์ ให้ redirect ไปยังหน้า index หลักหลังจาก 5 วินาที
    echo "<script>
            setTimeout(function() {
                window.location.href = 'index_user.php';
            }, 3000); // 3 วินาที
          </script>";
}
?>
