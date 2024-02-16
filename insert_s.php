<!DOCTYPE html>
<html>
<head>
    <title>เพิ่มข้อมูล</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
        }
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
        }
        input[type="text"], input[type="submit"], select {
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

<h2>เพิ่มข้อมูล</h2>
<form action="insert.php" method="post">
    <label for="s_id">รหัสนักเรียน:</label><br>
    <input type="text" id="s_id" name="s_id"><br>
    <label for="s_name">ชื่อนักเรียน:</label><br>
    <input type="text" id="s_name" name="s_name"><br>
    <label for="c_id">เลือก Club:</label><br>
    <select name="c_id" id="c_id">
        <?php
        // Include your database connection file here
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "testapi";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT c_id, c_name FROM club";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["c_id"] . "'>" . $row["c_name"] . "</option>";
            }
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </select><br><br>
    <input type="submit" value="Submit">
</form>
<button onclick="goBack()">Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>

</body>
</html>
