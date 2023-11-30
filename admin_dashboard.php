<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            color: rgb(9, 167, 230);
          margin-right: 10px;
          margin-top: 10px;
          font-size: 2em;
          margin-left: 10px;
          font-family: 'Times New Roman', Times, serif;
          
        }


        h1 {
            margin: 0;
            
        }

        h2{
          color: #0096FF;
          margin-top: 120px;
          font-size: 5em;
          font-family: cursive;
          margin-left: 200px;
           
        }

        
        h3 {
            color: yellow;
          font-size: 4em;
          margin-top: 50px;
          font-family: cursive;
          margin-left: 400px;
        }

        button {
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 30px;
            transition: background-color 0.3s;
            margin-left: 1000px;
            margin-top: 40px;
            margin-right: 100px;
        }

        button:hover {
            background-color: #2980b9;
        }

        a {
            color: #3498db;
            text-decoration: none;
            display: block;
            margin-top: 20px;
            font-size: 2em;
            animation: fadeIn 0.5s ease-in-out;
            margin-left: 1050px;
        }

        a:hover {
            text-decoration: underline;
            transform: translateY(-5px);
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
   
    <header>
        <div class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Your Logo" style="width: 80px; height: 50px;">
                <h1>| Course Court</h1>
    </div>
        </div>
    </header>
    <h2>Course Court </h2>
    <h3>Welcomes You  <?php echo $_SESSION["adminUsername"]; ?>!</h3>

    <!-- Admin Dashboard Buttons -->
    <button onclick="location.href='admin_manage_course.php'">Manage Courses</button><br>
    <button onclick="location.href='admin_manage_user.php'">Manage Users</button>

    <!-- Logout Link -->
    <br>
    <br>
    <a href="admin_logout.php">Logout</a>

</body>
</html>
