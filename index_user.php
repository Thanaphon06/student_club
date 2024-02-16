<!DOCTYPE html>
<html>
<head>
    <title>View Students by Club</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
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
        a {
            display: block;
            text-align: center;
            text-decoration: none;
            color: #4CAF50;
            margin-top: 20px;
        }
        a:hover {
            color: #45a049;
        }
    </style>
</head>
<body>

<?php
// Include your database connection file here

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the list of clubs with their names
    $stmt = $conn->query("SELECT c_id, c_name FROM club");
    $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<h2>View Students by Club</h2>

<form action="view_students.php" method="post">
    <label for="club">Select a Club:</label>
    <select name="club" id="club">
        <?php foreach($clubs as $club): ?>
            <option value="<?php echo $club['c_id']; ?>"><?php echo $club['c_name']; ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="View Students">
</form>

<a class="button" href="edit.php">แก้ไขข้อมูล</a>

<a href="club_edit.php">เปลี่ยนชมรม</a><br>

<a href="index.php">ออกจากระบบ</a><br>


</body>
</html>
