<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    
    <!-- Add CSS for colorful background and form styling -->
    <style>
         body{
          background: url('Images/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
        
        /* Basic styling for header */
        header {
          background-color: #f4c10a;
          padding: 20px 0;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .container {
          width: 90%;
          max-width: 1200px;
          margin: 0 auto;
          display: flex;
          justify-content: space-between;
          align-items: center;
        }
        
        .logo img {
          max-height: 40px; /* Adjust height as needed */
        }
        
        .logo h1 {
          color: rgb(9, 167, 230);
          margin-right: 10px;
        }
        
        .buttons {
          display: flex;
          align-items: center;
        }
        
        .buttons a {
          text-decoration: none;
          padding: 10px 20px;
          margin-left: 15px;
          border: 1px solid #000000;
          border-radius: 4px;
          color: #000000;
          transition: all 0.3s ease;
        }
        
        .buttons a:hover {
          background-color: #000000;
          color: #ffffff;
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
            color:#0096FF;
            text-align: center;
            margin-top:140px;
            font-size: 4em;
        }
        form {
            background-color:linen;
            padding: 70px;
            border-radius: 30px;
            width: 500px;
            height:450px;
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

    <h2>Registration Page</h2>
    <form action="register_process.php" method="POST">
        <label for="firstName">First Name:</label>
        <input type="text" name="firstName" required><br>
        <br>

        <label for="lastName">Last Name:</label>
        <input type="text" name="lastName" required><br>
        <br>

        <label for="email">Email Id:</label>
        <input type="email" name="email" required><br>

        <br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
        <br>

        <label for="dob">Date of Birth:</label>
        <input type="date" name="dob" required><br>

        <br>

        <input type="submit" value="Register">
    </form>

   
</body>
</html>
