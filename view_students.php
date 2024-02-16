<?php
// Include your database connection file here

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "testapi";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if(isset($_POST['club'])) {
        $selected_club = $_POST['club'];

        // Fetch the club name
        $stmt_club = $conn->prepare("SELECT c_name FROM club WHERE c_id = :club");
        $stmt_club->bindParam(':club', $selected_club);
        $stmt_club->execute();
        $club_name = $stmt_club->fetchColumn();

        // Fetch the students who are members of the selected club
        $stmt_students = $conn->prepare("SELECT s_id, s_name FROM students WHERE s_id IN (SELECT s_id FROM memberclub WHERE c_id = :club)");
        $stmt_students->bindParam(':club', $selected_club);
        $stmt_students->execute();
        $students = $stmt_students->fetchAll(PDO::FETCH_ASSOC);
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>

<html>
<head>
    <title>View Students</title>
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
        table {
            width: 50%;
            margin: 20px auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        p {
            text-align: center;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2>Students in Club <?php echo $club_name; ?></h2>

<?php if(isset($students)): ?>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
        </tr>
        <?php foreach($students as $student): ?>
            <tr>
                <td><?php echo $student['s_id']; ?></td>
                <td><?php echo $student['s_name']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>No club selected.</p>
<?php endif; ?>

<button onclick="goBack()">Back</button>

<script>
function goBack() {
    window.history.back();
}
</script>
</body>
</html>