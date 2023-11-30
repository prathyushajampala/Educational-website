<?php
include("db_config.php");

session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

// Fetch user details based on the logged-in username
$sql = "SELECT * FROM register_details WHERE User_id = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $firstName = $row["FirstName"];
    $lastName = $row["Lastname"];
    $dateOfBirth = $row["Date_of_birth"];
    $email = $row["Email_id"];
} else {
    // Handle the case where user details are not found
    header("Location: login.php");
    exit();
}

// Handle form submission for profile update
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newFirstName = $_POST["new_first_name"];
    $newLastName = $_POST["new_last_name"];
    $newDateOfBirth = $_POST["new_date_of_birth"];
    $newEmail = $_POST["new_email"];

    // Update user details in the database
    $updateSql = "UPDATE register_details SET FirstName='$newFirstName', Lastname='$newLastName', 
                  Date_of_birth='$newDateOfBirth', Email_id='$newEmail' WHERE User_id='$username'";
    if ($conn->query($updateSql) === TRUE) {
        echo "Profile updated successfully!";
        // You can redirect the user to the dashboard or another page after the update.
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Course Court</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            animation: fadeIn 1s ease-out; /* Add a fadeIn animation to the body */
        }
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }

        header {
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: 0 auto;
        }

        .logo img {
            width: 80px;
            height: 50px;
        }

        .logo h1 {
            margin-left: 10px;
            color: #333;
        }

        .user-info p {
            margin: 0;
            color: #333;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            align-items: center;
        }

        .buttons a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .buttons a:hover {
            background: #333;
            color: #fff;
        }
        /* body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }*/

        /*header {
            background: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }*/

        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 80%;
            margin: 0 auto;
        }

        .logo img {
            width: 80px;
            height: 50px;
        }

        .logo h1 {
            margin-left: 10px;
            color: #333;
        }

        .user-info p {
            margin: 0;
            color: #333;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            align-items: center;
        }

        .buttons a {
            text-decoration: none;
            color: #333;
            padding: 10px;
            margin: 0 10px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .buttons a:hover {
            background: #333;
            color: #fff;
        }

        main {
            padding: 20px;
            width: 80%;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        label {
            margin-top: 10px;
            font-weight: bold;
        }

        input {
            padding: 10px;
            margin: 5px 0;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            background: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <img src="Images/logo.png" alt="Your Logo" style="width: 80px; height: 50px;">
                <h1>| Course Court</h1>
            </div>
            <div class="user-info">
                <p>Welcome, <?php echo $firstName; ?></p>
            </div>
            <div class="buttons">
                <a href="dashboard.php" class="dashboard-btn">Dashboard</a>
                <a href="#" class="logout-btn">Logout</a>
            </div>
        </div>
    </header>

    <main>
        <h2>Edit Profile</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="new_first_name">First Name:</label>
            <input type="text" name="new_first_name" value="<?php echo $firstName; ?>" required>

            <label for="new_last_name">Last Name:</label>
            <input type="text" name="new_last_name" value="<?php echo $lastName; ?>" required>

            <label for="new_date_of_birth">Date of Birth:</label>
            <input type="date" name="new_date_of_birth" value="<?php echo $dateOfBirth; ?>" required>

            <label for="new_email">Email:</label>
            <input type="email" name="new_email" value="<?php echo $email; ?>" required>

            <button type="submit">Update Profile</button>
        </form>
    </main>
</body>
</html>
