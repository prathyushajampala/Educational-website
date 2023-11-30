<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Check if the user ID is provided in the URL
if (isset($_GET["user_id"])) {
    $userID = $_GET["user_id"];

    // Fetch user details from the register_details table based on the user ID
    $sqlUserDetails = "SELECT * FROM register_details WHERE User_id = '$userID'";
    $resultUserDetails = $conn->query($sqlUserDetails);

    if ($resultUserDetails->num_rows == 1) {
        $userDetails = $resultUserDetails->fetch_assoc();
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

// Update user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST["newFirstName"];
    $newLastName = $_POST["newLastName"];
    $newDateOfBirth = $_POST["newDateOfBirth"];
    $newEmail = $_POST["newEmail"];
    $newUsername = $_POST["newUsername"];
    $newPassword = password_hash($_POST["newPassword"], PASSWORD_DEFAULT); // Hash the new password

    // Update the user details in the register_details table
    $sqlUpdateUser = "UPDATE register_details SET FirstName = '$newFirstName', Lastname = '$newLastName', Date_of_birth = '$newDateOfBirth', Email_id = '$newEmail', User_id = '$newUsername', Password = '$newPassword' WHERE User_id = '$userID'";

    if ($conn->query($sqlUpdateUser) === TRUE) {
        echo "User details updated successfully!";
        header("Refresh: 2; URL=admin_manage_user.php");
        exit();
    } else {
        echo "Error updating user details: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(45deg, #FFA07A, #FF6347);
            color: #fff;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h2 {
            text-align: center;
        }

        form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 300px;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        a {
            color: #fff;
            text-decoration: none;
            display: block;
            margin-top: 20px;
            font-size: 18px;
            text-align: center;
            transition: color 0.3s;
        }

        a:hover {
            color: #eee;
        }
    </style>
</head>
<body>
    <h2>Edit User</h2>

    <!-- Edit User Form -->
    <form action="edit_user.php?user_id=<?php echo $userID; ?>" method="POST">
        <!-- Display existing user details in the form -->
        <label for="newFirstName">First Name:</label>
        <input type="text" name="newFirstName" value="<?php echo $userDetails['FirstName']; ?>" required><br>

        <label for="newLastName">Last Name:</label>
        <input type="text" name="newLastName" value="<?php echo $userDetails['Lastname']; ?>" required><br>

        <label for="newDateOfBirth">Date of Birth:</label>
        <input type="date" name="newDateOfBirth" value="<?php echo $userDetails['Date_of_birth']; ?>" required><br>

        <label for="newEmail">Email:</label>
        <input type="email" name="newEmail" value="<?php echo $userDetails['Email_id']; ?>" required><br>

        <label for="newUsername">Username:</label>
        <input type="text" name="newUsername" value="<?php echo $userDetails['User_id']; ?>" required><br>

        <label for="newPassword">New Password:</label>
        <input type="password" name="newPassword" required><br>

        <input type="submit" value="Update User">
    </form>

    <!-- Back to Manage User Link -->
    <br>
    <a href="admin_manage_user.php">Back to Manage User</a>
</body>
</html>
