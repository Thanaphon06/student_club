<!DOCTYPE html>
<html>
<head>
    <title>ลบข้อมูล</title>
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

<h2>ลบข้อมูล</h2>
<form action="c_delete_data.php" method="post">
    <label for="c_id">รหัสนักเรียน:</label><br>
    <input type="text" id="c_id" name="c_id"><br><br>
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
