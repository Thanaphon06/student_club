<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="password"], input[type="submit"] {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            width: 300px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            padding: 10px 20px;
            border: none;
            background-color: #ccc;
            color: #333;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h2>Edit Record</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $stmt = $conn->prepare("SELECT * FROM students WHERE s_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<form action='update.php' method='post'>";
        echo "<label for='s_id'>รหัสนักเรียน:</label><br>";
        echo "<input type='text' id='s_id' name='s_id' value='".$row['s_id']."'><br>";
        echo "<label for='s_name'>ชื่อนักเรียน:</label><br>";
        echo "<input type='text' id='s_name' name='s_name' value='".$row['s_name']."'><br><br>";
        echo "<input type='hidden' name='id' value='".$row['s_id']."'>";
        echo "<input type='submit' value='Submit'>";
        echo "</form>";
    } else {
        echo "ไม่พบรหัสนักเรียนที่ต้องการแก้ไข";
    }
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . $e->getMessage();
}

$conn = null;
?>

<form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <!-- รับค่า ID จากผู้ใช้ -->
    <input type="text" name="id" placeholder="รหัสนักเรียนที่ต้องการแก้ไข">
    <!-- ปุ่ม submit สำหรับแก้ไขข้อมูล -->
    <input type="submit" value="แก้ไขข้อมูล">
</form>
<button onclick="goBack()">Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>
