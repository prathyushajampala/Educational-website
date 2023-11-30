<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Add Course
if (isset($_POST["addCourse"])) {
    $courseName = $_POST["courseName"];
    $description = $_POST["description"];
    $contents = $_POST["contents"];
    $textbook = $_POST["textbook"];

    $sql = "INSERT INTO course_list (CourseName, Description, Contents, Textbook) VALUES ('$courseName', '$description', '$contents', '$textbook')";
    $conn->query($sql);
}

// Edit or Delete Course
if (isset($_GET["action"])) {
    $action = $_GET["action"];
    $courseID = $_GET["id"];

    if ($action == "edit") {
        // Fetch course details for editing
        $sql = "SELECT * FROM course_list WHERE CourseID = $courseID";
        $result = $conn->query($sql);
        $course = $result->fetch_assoc();
    } elseif ($action == "delete") {
        // Delete course
        $sql = "DELETE FROM course_list WHERE CourseID = $courseID";
        $conn->query($sql);
    }
}

// Update Course
if (isset($_POST["updateCourse"])) {
    $courseID = $_POST["courseID"];
    $courseName = $_POST["courseName"];
    $description = $_POST["description"];
    $contents = $_POST["contents"];
    $textbook = $_POST["textbook"];

    $sql = "UPDATE course_list SET CourseName = '$courseName', Description = '$description', Contents = '$contents', Textbook = '$textbook' WHERE CourseID = $courseID";
    $conn->query($sql);
}

// Fetch all courses after adding, updating, or deleting
$sql = "SELECT * FROM course_list";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Manage Course</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 1500px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }

        .container h3 {
            color: #3498db;
            text-align: center;
            margin-bottom: 20px;
            max-width: 500px;
        }

        form {
            background-color: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 400px;
            width: 1800px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #3498db;
        }

        input[type="text"], textarea, input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #3498db;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
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

        a {
            color: #3498db;
            text-decoration: none;
            display: block;
            margin-top: 20px;
            font-size: 18px;
            animation: fadeIn 0.5s ease-in-out;
        }

        a:hover {
            text-decoration: underline;
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
<div class="container">
            <div class="logo">
              <img src="images/logo.png" alt="Your Logo" style="width: 80px; height: 50px;">
                <h1>| Course Court</h1>
            </div>
    <h3>Manage Courses</h3>

    <!-- Edit Course Form -->
    <?php if (isset($course) && $course != null) { ?>
        <form action="admin_manage_course.php" method="POST">
            <input type="hidden" name="courseID" value="<?php echo $course["CourseID"]; ?>">
            <label for="courseName">Course Name:</label>
            <input type="text" name="courseName" value="<?php echo $course["CourseName"]; ?>" required>
            <label for="description">Description:</label>
            <input type="text" name="description" value="<?php echo $course["Description"]; ?>" required>
            <label for="contents">Contents:</label>
            <textarea type="text" name="contents" rows="4" cols="50"><?php echo $course["Contents"]; ?></textarea>
            <label for="textbook">Textbook:</label>
            <input type="url" name="textbook" value="<?php echo $course["Textbook"]; ?>"><br>
            <input type="submit" name="updateCourse" value="Update Course">
        </form>
    <?php } else { ?>

    <!-- Add Course Form -->
    <form action="admin_manage_course.php" method="POST">
        <label for="courseName">Course Name:</label>
        <input type="text" name="courseName" required>
        <label for="description">Description:</label>
        <input type="text" name="description" required>
        <label for="contents">Contents:</label>
        <textarea type="text" name="contents" rows="4" cols="50"></textarea>
        <label for="textbook">Textbook:</label>
        <input type="url" name="textbook" class="linkin">
        <br>
        <br>
        <br>
        <input type="submit" name="addCourse" value="Add Course">
    </form>

    <?php } ?>

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
    <a href="admin_add_quiz.php">Ad Quiz</a>
    <!-- Logout Link -->
    <a href="admin_logout.php">Logout</a>

</body>
<script>
    document.getElementById("myForm").addEventListener("submit", function(event) {
        // Get the value of the input field
        const linkValue = document.getElementById("linkin").value;

        // Regular expression to check if the link starts with http:// or https://
        const urlRegex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;

        // Check if the link is a valid URL
        if (!urlRegex.test(linkValue)) {
            alert("Please enter a valid URL.");
            event.preventDefault(); // Prevent the form from submitting
        }
    });
</script>
</html>
