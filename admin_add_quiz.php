<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Fetch course details from the course_list table
$sqlCourses = "SELECT * FROM course_list";
$resultCourses = $conn->query($sqlCourses);

// Fetch existing quiz questions from the quiz_questions table
$sqlQuizQuestions = "SELECT * FROM quiz_questions";
$resultQuizQuestions = $conn->query($sqlQuizQuestions);

// Add new quiz question
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseID = $_POST["courseID"];
    $question = $_POST["question"];
    $correctAnswer = $_POST["correctAnswer"];

    // Insert the new quiz question into the quiz_questions table
    $sqlAddQuizQuestion = "INSERT INTO quiz_questions (CourseID, Question, CorrectAnswer) VALUES ('$courseID', '$question', '$correctAnswer')";
    if ($conn->query($sqlAddQuizQuestion) === TRUE) {
        echo "Quiz question added successfully! Redirecting to quiz section...";
        header("Refresh: 2; URL=admin_add_quiz.php");
        exit();
    } else {
        echo "Error: " . $sqlAddQuizQuestion . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Quiz Question</title>
    <style>
        
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f2f2f2;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2, h3 {
            color: #3498db;
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            max-width: 400px;
            width: 100%;
            animation: fadeIn 0.5s ease-in-out;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #3498db;
        }

        select, input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
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

        a {
            color: #3498db;
            text-decoration: none;
            display: block;
            margin-top: 10px;
            animation: fadeIn 0.5s ease-in-out;
        }

        a:hover {
            text-decoration: underline;
        }

        h3 {
            margin-top: 20px;
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
    <h3>Add Quiz Question</h3>

    <!-- Quiz Question Form -->
    <form action="admin_add_quiz.php" method="POST">
        <label for="courseID">Select Course:</label>
        <select name="courseID" required>
            <?php
            if ($resultCourses && $resultCourses->num_rows > 0) {
                while ($course = $resultCourses->fetch_assoc()) {
                    echo "<option value='" . $course["CourseID"] . "'>" . $course["CourseName"] . "</option>";
                }
            } else {
                echo "<option value='' disabled>No courses available</option>";
            }
            ?>
        </select><br>

        <label for="question">Quiz Question:</label>
        <input type="text" name="question" required><br>

        <label for="correctAnswer">Correct Answer:</label>
        <input type="text" name="correctAnswer" required><br>

        <input type="submit" value="Add Quiz Question">
    </form>

    <!-- Back to Dashboard Link -->
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>

    <!-- Display Existing Quiz Questions -->
    <h3>Existing Quiz Questions:</h3>
    <?php
    if ($resultQuizQuestions && $resultQuizQuestions->num_rows > 0) {
        while ($quizQuestion = $resultQuizQuestions->fetch_assoc()) {
            echo "Course ID: " . $quizQuestion["CourseID"] . " - Question: " . $quizQuestion["Question"] . " - Correct Answer: " . $quizQuestion["CorrectAnswer"] . "<br>";
        }
    } else {
        echo "No quiz questions found.";
    }
    ?>
</body>
</html>
