<!DOCTYPE html>
<html>
<head>
    <title>รายชื่อนักเรียนและชมรม</title>
    <style>
        body {
            text-align: center;
        }
        h2 {
            margin-top: 50px;
            margin-bottom: 20px;
            color: #333;
            font-family: Arial, sans-serif;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            border: 1px solid #333;
        }
        th, td {
            border: 1px solid #333;
            padding: 10px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a.button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
        }
        a.button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>รายชื่อนักเรียนและชมรม</h2>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ดึงข้อมูลจากตาราง student, club, และ memberclub โดยใช้ JOIN
    $sql = "SELECT students.s_id, students.s_name, club.c_id, club.c_name
            FROM students
            INNER JOIN memberclub ON students.s_id = memberclub.s_id
            INNER JOIN club ON memberclub.c_id = club.c_id";
    $result = $conn->query($sql);

    if ($result->rowCount() > 0) {
        echo "<table>";
        echo "<tr><th>รหัสนักเรียน</th><th>ชื่อนักเรียน</th><th>รหัสชมรม</th><th>ชื่อชมรม</th></tr>";
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".$row['s_id']."</td>";
            echo "<td>".$row['s_name']."</td>";
            echo "<td>".$row['c_id']."</td>";
            echo "<td>".$row['c_name']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "ไม่พบข้อมูลนักเรียนและชมรม";
    }
} catch(PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
$conn = null;
?>

<a class="button" href="edit.php">แก้ไขข้อมูล</a>
<a class="button" href="insert_s.php">เพิ่มข้อมูล</a>
<a class="button" href="delete_s.php">ลบข้อมูล</a>
<a class="button" href="club_insert.php">เพิ่มชมรม</a>
<a class="button" href="c_delete.php">ลบชมรม</a>
<a class="button" href="c_edit.php">แก้ไขข้อมูลชมรม</a>

<a class="button" href="index.php">ออกจากระบบ</a><br>

</body>
</html>
