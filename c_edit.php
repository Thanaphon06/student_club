<!DOCTYPE html>
<html>
<head>
    <title>Edit Record</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
        }
        form {
            width: 50%;
            margin: 0 auto;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        button {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Record</h2>

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

        // ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
        if(isset($_GET['id'])) {
            $id = $_GET['id'];

            // เรียกข้อมูลที่ต้องการแก้ไขจากฐานข้อมูล
            $stmt = $conn->prepare("SELECT * FROM club WHERE c_id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // เริ่มแบบฟอร์มเพื่อแก้ไขข้อมูล
            echo "<form action='c_edit_data.php' method='post'>";
            echo "<label for='c_id'>รหัสชมรม:</label><br>";
            echo "<input type='text' id='c_id' name='c_id' value='".$row['c_id']."'><br>";
            echo "<label for='c_name'>ชื่อชมรม:</label><br>";
            echo "<input type='text' id='c_name' name='c_name' value='".$row['c_name']."'><br><br>";
            echo "<input type='hidden' name='id' value='".$row['c_id']."'>";
            echo "<input type='submit' value='Submit'>";
            echo "</form>"; // สิ้นสุดแบบฟอร์ม
        } else {
            echo "<p>ไม่พบรหัสชมรมที่ต้องการแก้ไข</p>";
        }
    } catch(PDOException $e) {
        echo "เกิดข้อผิดพลาดในการเชื่อมต่อฐานข้อมูล: " . $e->getMessage();
    }

    // ปิดการเชื่อมต่อ
    $conn = null;
    ?>

    <form method="get" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- รับค่า ID จากผู้ใช้ -->
        <input type="text" name="id" placeholder="รหัสต้องการแก้ไข">
        <!-- ปุ่ม submit สำหรับลบข้อมูล -->
        <input type="submit" value="แก้ไขข้อมูล">
    </form>
    <button onclick="goBack()">Back</button>
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>
</body>
</html>
