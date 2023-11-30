<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <style>
        body {
            background: linear-gradient(to right, #ff7e5f, #feb47b);
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }
        
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        h2 {
            color: white;
            font-size: 3em;
            text-align: center;
            margin-top: 50px;
        }
        
        form {
            background-color:linen;
            padding: 70px;
            border-radius: 30px;
            width: 200px;
            height:200px;
            margin: 20px auto;
            margin-top:80px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.5s ease-in-out; /* Add animation */
        }
        
        
        form:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
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
        /*
        
        body {
            background: url('Images/background.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            font-family: 'Arial', sans-serif;
            overflow: hidden;
        }
        
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }*/
        
        h2{
            color:white;
            text-align: center;
            margin-top:100px;
            font-size: 3em;
        }
        form {
            background-color:linen;
            padding: 70px;
            border-radius: 30px;
            width: 300px;
            height:200px;
            margin: 20px auto;
            margin-top:80px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.5s ease-in-out; /* Add animation */
        }
        
        /*form {
            align-content: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 80px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            
            
        }*/
        
        form:hover {
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.2ß);
            transform: translateY(-5px);
        }
        /* Animation Keyframes */
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
                <a href="register.php" class="register-btn">Register</a>
                <a href="admin_login.php" class="login-btn">Admin Login</a>
                <a href="login.php" class="login-btn">Login</a>
                <a href="index.html" class="home-btn">Home</a>
            </div>
        </div>
    </header>

    <h2>Admin Login Page</h2>
    <form action="admin_login_process.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <br>

        <input type="submit" value="Login">
    </form>
</body>
</html>
