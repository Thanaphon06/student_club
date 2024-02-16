<?php
session_start(); // เริ่ม Session
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM students WHERE s_name = :username AND s_id = :password");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        
        $user = $stmt->fetch();

        if($user) {
            $_SESSION['username'] = $username; // เก็บ username ใน Session

            if($username === "root") {
                header("Location: index_root.php");
                exit();
            } else {
                header("Location: index_user.php");
                exit();
            }
        } else {
            echo "Invalid username or password.";
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
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
