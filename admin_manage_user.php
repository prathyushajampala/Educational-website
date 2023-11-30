<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Fetch all user details from the register_details table
$sql = "SELECT * FROM register_details";
$result = $conn->query($sql);

// Handle actions (Edit and Delete)
if (isset($_GET["action"]) && isset($_GET["id"])) {
    $action = $_GET["action"];
    $userID = $_GET["id"];

    if ($action === "edit") {
        // Redirect to edit_user.php with the user ID
        header("Location: edit_user.php?user_id=$userID");
        exit();
    } elseif ($action === "delete") {
        // Redirect to delete_user.php with the user ID
        header("Location: delete_user.php?user_id=$userID");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage User</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            animation: fadeIn 0.5s ease-in-out;
        }

        h2, h3 {
            color: #3498db;
            text-align: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
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

        a {
            color: #3498db;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            font-size: 16px;
            transition: color 0.3s;
        }

        a:hover {
            color: #207dbb;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["adminUsername"]; ?>!</h2>
    <h3>Manage Users</h3>

    <!-- Display All Users -->
    <table border="1">
        <tr>
            <th>User ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Date of Birth</th>
            <th>Email ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Actions</th>
            <th>View Score</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["User_id"] . "</td>";
            echo "<td>" . $row["FirstName"] . "</td>";
            echo "<td>" . $row["Lastname"] . "</td>";
            echo "<td>" . $row["Date_of_birth"] . "</td>";
            echo "<td>" . $row["Email_id"] . "</td>";
            echo "<td>" . $row["User_id"] . "</td>";
            echo "<td>" . $row["Password"] . "</td>";
            echo "<td><a href='admin_manage_user.php?action=edit&id=" . $row["User_id"] . "'>Edit</a> | <a href='admin_manage_user.php?action=delete&id=" . $row["User_id"] . "'>Delete</a></td>";
            echo "<td><a href='admin_view_score.php?id=" . $row["User_id"] . "'>View Score</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>
    <a href="admin_view_score.php">View Score</a>
    <!-- Logout Link -->
    <a href="admin_logout.php">Logout</a>

</body>
</html>
