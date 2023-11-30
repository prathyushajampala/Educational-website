<?php
include("db_config.php");
session_start();

if (isset($_POST["addCourse"])) {
    // Process the form data and add a course
    $courseName = $_POST["courseName"];
    $description = $_POST["description"];
    $contents = $_POST["contents"];
    $textbook = $_POST["textbook"];
    $question = $_POST["question"];
    $correctAnswer = $_POST["correctAnswer"];

    // TODO: Add the course and quiz to the database
    // Insert course data into course_list table
    $insertCourseSQL = "INSERT INTO course_list (CourseName, Description, Contents, Textbook) VALUES ('$courseName', '$description', '$contents', '$textbook')";
    // Execute the SQL statement

    // TODO: Get the CourseID of the newly added course
    $newCourseID = mysqli_insert_id($conn);

    // Insert quiz data into quiz_questions table
    $insertQuizSQL = "INSERT INTO quiz_questions (CourseID, Question, CorrectAnswer) VALUES ('$newCourseID', '$question', '$correctAnswer')";
    // Execute the SQL statement

    // Redirect back to admin.php after processing
    header("Location: admin.php");
    exit();
}

if (isset($_POST["deleteCourse"])) {
    // Process the form data and delete a course
    $courseIDToDelete = $_POST["courseIDToDelete"];

    // TODO: Delete the course and associated quizzes from the database
    // Delete course from course_list table
    $deleteCourseSQL = "DELETE FROM course_list WHERE CourseID = '$courseIDToDelete'";
    // Execute the SQL statement

    // TODO: Delete quizzes associated with the course from quiz_questions table
    $deleteQuizzesSQL = "DELETE FROM quiz_questions WHERE CourseID = '$courseIDToDelete'";
    // Execute the SQL statement

    // Redirect back to admin.php after processing
    header("Location: admin.php");
    exit();
}

if (isset($_POST["updateCourse"])) {
    // Process the form data and update a course
    $courseIDToUpdate = $_POST["courseIDToUpdate"];
    $newDescription = $_POST["newDescription"];
    $newContents = $_POST["newContents"];
    $newTextbook = $_POST["newTextbook"];

    // TODO: Update the course data in the database
    // Update course_list table
    $updateCourseSQL = "UPDATE course_list SET Description = '$newDescription', Contents = '$newContents', Textbook = '$newTextbook' WHERE CourseID = '$courseIDToUpdate'";
    // Execute the SQL statement

    // Redirect back to admin.php after processing
    header("Location: admin.php");
    exit();
}
?>
