<!DOCTYPE html>
<html>
<head>
    <title>รายชื่อนักเรียนและชมรม</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
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

</body>
</html>
