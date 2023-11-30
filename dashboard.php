<?php
// Include the necessary database connection code
include("db_config.php");

// Assume you have a session started after successful login
session_start();

// Check if the user is logged in, if not, redirect to login page
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Fetch user details based on the logged-in username
$username = $_SESSION["username"];
$sql = "SELECT * FROM register_details WHERE User_id = '$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $firstName = $row["FirstName"];
} else {
    // Handle the case where user details are not found
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Course Court</title>
    <style>
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

        main {
            padding: 20px;
            width: 80%;
            margin: 20px auto;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            text-align: center;
        }

        .course {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .course img {
            max-width: 100px;
            max-height: 100px;
            margin-right: 20px;
            border-radius: 5px;
        }

        .course-info {
            flex-grow: 1;
        }

        .course:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
        }

        .enroll-btn {
            background: #333;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .enroll-btn:hover {
            background: #555;
        }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
              <img src="images/logo.png" alt="Your Logo" style="width: 80px; height: 50px;">
                <h1>| Course Court</h1>
            </div>
            <div class="user-info">
                <p>Welcome, <?php echo $firstName; ?></p>
            </div>
            <div class="buttons">
                <a href="courselist.php" class="Courselist-btn">View Courselist</a>
                <a href="Programme.html" class="programs-btn">Programs</a>
                <a href="edit_profile.php" class="edit-profile-btn">Edit Profile</a>
                <a href="result.php" class="results-btn">Results</a>
                <a href="query.php" class="query-btn">Query</a>
                <a href="logout.php" class="sign-out-btn">Sign Out</a>
            </div>
        </div>
    </header>

    <main>
        <h2>Available Courses</h2>
        <?php
        // Fetch and display available courses
        $courseSql = "SELECT * FROM course_list";
            $courseResult = $conn->query($courseSql);

            if ($courseResult->num_rows > 0) {
                while ($courseRow = $courseResult->fetch_assoc()) {
                    echo '<div class="course">';
                    echo '<img src="' . $courseRow["ImageURL"] . '" alt="' . $courseRow["CourseName"] . ' Image">';
                    echo '<div class="course-info">';
                    echo '<h3>' . $courseRow["CourseName"] . '</h3>';
                    echo '<p>' . $courseRow["Description"] . '</p>';
                    echo '</div>';
                    echo '<form action="enroll.php" method="GET">'; // Change the method to GET
                    echo '<input type="hidden" name="course_id" value="' . $courseRow["CourseID"] . '">';
                    echo '<button type="submit" class="enroll-btn">Open</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } else {
                echo '<p>No courses available.</p>';
            }
            ?>
</main>


</body>
</html>
