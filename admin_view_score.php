<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Fetch scores from the quiz table
$sql = "SELECT * FROM quiz";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Scores</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2, h3 {
            color: #3498db;
            text-align: center;
        }

        a {
            color: #3498db;
            text-decoration: none;
            display: block;
            margin-top: 20px;
            font-size: 18px;
            transition: color 0.3s;
        }

        a:hover {
            color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #3498db;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: #fff;
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["adminUsername"]; ?>!</h2>
    <h3>View User Scores</h3>

    <!-- Display Scores -->
    <?php
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Student Name: " . $row["student_name"] . " - Score: " . $row["score"] . "<br>";
        }
    } else {
        echo "No scores found.";
    }
    ?>

    <!-- Back to Dashboard Link -->
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>

</body>
</html>
