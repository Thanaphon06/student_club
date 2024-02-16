<?php
// Include your database connection file here

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

// Initialize variables
$s_id = "";
$c_id = "";

// Fetch the list of clubs
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch the list of clubs
    $stmt = $conn->query("SELECT DISTINCT c_id FROM memberclub");
    $clubs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_POST['s_id'])) {
        $s_id = $_POST['s_id'];

        // Fetch the club associated with the provided s_id
        $stmt = $conn->prepare("SELECT c_id FROM memberclub WHERE s_id = :s_id");
        $stmt->bindParam(':s_id', $s_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result) {
            $c_id = $result['c_id'];
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Member Club</title>
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
            margin: 20px auto;
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
        input[type="text"], select, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        select {
            height: 40px; /* Adjust the height as needed */
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
            display: block;
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #ccc;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h2>Edit Member Club</h2>

<form action="club_change_data.php" method="post">
    <label for="s_id">Student ID:</label><br>
    <input type="text" id="s_id" name="s_id" value="<?php echo $s_id; ?>"><br><br>
    
    <label for="c_id">Select a Club:</label>
    
    <select name="c_id" id="c_id">
        <?php foreach($clubs as $club): ?>
            <?php
            // Fetch club name based on club ID
            $stmt = $conn->prepare("SELECT c_name FROM club WHERE c_id = :c_id");
            $stmt->bindParam(':c_id', $club['c_id']);
            $stmt->execute();
            $club_name = $stmt->fetchColumn();
            ?>
            <option value="<?php echo $club['c_id']; ?>" <?php if($club['c_id'] == $c_id) echo "selected"; ?>><?php echo $club_name; ?></option>
        <?php endforeach; ?>
    </select><br><br>

    <input type="submit" value="Update Club">
</form>
<button onclick="goBack()">Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>

</body>
</html>
