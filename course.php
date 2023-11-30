<?php
include("db_config.php");

session_start();

// Check if the user is logged in
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
    <title>Available Courses - Course Court</title>
    <!-- Add your CSS styles here -->
</head>
<body>
    <header>
        <!-- Your header content -->
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
                echo '<img src="' . $courseRow["ImageURL"] . '" alt="' . $courseRow["CourseName"] . '" style="width: 100px; height: 100px;">';
                echo '<h3>' . $courseRow["CourseName"] . '</h3>';
                echo '<p>' . $courseRow["Description"] . '</p>';
                echo '<form action="enroll.php" method="POST">';
                echo '<input type="hidden" name="course_id" value="' . $courseRow["CourseID"] . '">';
                echo '<button type="submit" class="enroll-btn">open</button>';
                echo '</form>';
                echo '</div>';
            }
        } else {
            echo '<p>No courses available.</p>';
        }
        ?>
    </main>
</body>
<style>
   
    
    </style>
</html>
