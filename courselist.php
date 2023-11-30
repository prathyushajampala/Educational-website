<?php
include("db_config.php");

session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

// Fetch quiz results for the logged-in student
$fetchQuizResultsQuery = "SELECT q.student_name, q.score, c.CourseName
                          FROM quiz q
                          JOIN course_list c ON q.CourseID = c.CourseID
                          WHERE q.student_name = '$username'";
$quizResults = $conn->query($fetchQuizResultsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
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
       /* header {
            background-color: #3498db;
            padding: 20px;
            text-align: center;
            color: #fff;
            animation: slideInDown 1s ease-out; /* Add a slideInDown animation to the header 
        }*/

        h1 {
            color: #333;
            margin-left: 120px;
            animation: fadeInUp 1s ease-out; /* Add a fadeInUp animation to the h1 element */
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            text-align: left;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle box shadow to the table */
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color:#cceeff;
            color: black;
        }
        p{
            margin-left: 130px;
        }

        tr:hover {
            background-color: white; /* Change the background color on hover */
        }


        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideInDown {
            from {
                transform: translateY(-50px);
            }
            to {
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
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
            <div class="buttons">
                <a href="Programme.html" class="programs-btn">Programs</a>
                <a href="edit_profile.php" class="edit-profile-btn">Edit Profile</a>
                <a href="result.php" class="results-btn">Results</a>
                <a href="query.php" class="query-btn">Query</a>
                <a href="logout.php" class="sign-out-btn">Sign Out</a>
            </div>
        </div>
        
        
    </header>
    <h1>Successfully Completed Courses</h1>
        <p>Welcome, <?php echo $username; ?>!</p>

        <table>
        <tr>
            <th>Course Name</th>
        </tr>
        <?php
        if ($quizResults->num_rows > 0) {
            while ($row = $quizResults->fetch_assoc()) {
                $result_score = isset($row['score']) ? $row['score'] : 0;
                $result = ($result_score >= 3) ? 'Pass' : 'Fail';
                if ($result==='Pass'){
                echo "<tr>";

               
                echo "<td>" . (isset($row['CourseName']) ? $row['CourseName'] : '') . "</td>";
             
                echo "</tr>";
                }
                
            }
        }
         else {
            echo "<tr><td colspan='3'>You have no completed courses avalaible now</td></tr>";
        }
        ?>
    </table>
</body>
</html>
