<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Fetch all courses from the course_list table
$sql = "SELECT * FROM course_list";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION["adminUsername"]; ?>!</h2>
    <h3>Manage Courses</h3>

    <!-- Add Course Form -->
    <form action="admin_manage_course.php" method="POST">
        <label for="courseName">Course Name:</label>
        <input type="text" name="courseName" required>
        <label for="description">Description:</label>
        <input type="text" name="description" required>
        <label for="contents">Contents:</label>
        <textarea name="contents" rows="4" cols="50"></textarea>
        <label for="textbook">Textbook:</label>
        <input type="text" name="textbook">
        <input type="submit" name="addCourse" value="Add Course">
    </form>

    <!-- Display All Courses -->
    <h3>All Courses</h3>
    <table border="1">
        <tr>
            <th>Course ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Contents</th>
            <th>Textbook</th>
            <th>Actions</th>
        </tr>
        <?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["CourseID"] . "</td>";
            echo "<td>" . $row["CourseName"] . "</td>";
            echo "<td>" . $row["Description"] . "</td>";
            echo "<td>" . $row["Contents"] . "</td>";
            echo "<td>" . $row["Textbook"] . "</td>";
            echo "<td><a href='admin_manage_course.php?action=edit&id=" . $row["CourseID"] . "'>Edit</a> | <a href='admin_manage_course.php?action=delete&id=" . $row["CourseID"] . "'>Delete</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <br>

    <!-- Logout Link -->
    <a href="admin_logout.php">Logout</a>

</body>

</html>
