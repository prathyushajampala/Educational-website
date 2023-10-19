<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Managing the user accounts</title>
</head>

	<style type="text/css">
		*{
			text-decoration: none;
		}
		.navbar{
			background: orange; 
            font-family: calibri;
            padding-right: 15px;
            padding-left: 15px;
		}
        h1{
            color:blue;
        }
		.navdiv{
			display: flex;
            align-items: center;
            justify-content: space-between;
		}
		.logo a{
			font-size: 35px;
            font-weight: 600;
            color: white;
		}
		li{
			list-style: none;
            display: inline-block;
		}
		li a{
			color: skyblue;
            font-size: 22px;
            margin-right: 25px;
		}
		button{
			background-color: black;
            margin-left: 10px;
            border-radius: 10px; 
            padding: 10px; 
            width: 90px;
		}
		button a{
			color: white; 
            font-weight: bold;
            font-size: 15px;
		}
        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            flex: 1;
        }
        a {
            text-decoration: none; /* Remove underline for all anchor tags */
        }
        .button-container {
            text-align: center;
        }
        button {
            display: block;
            width: 500px;
            height: 90px;
            padding: 10px;
            margin: 100px;
            background-color: orange;
            color: #fff;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            box-shadow: 0px 0px 2px 2px rgb(0,0,0);
        }
        img {
            max-width: 100%;
            height: 650px;
        }
        body {
            margin: 0;
            padding: 0;
            background-size: cover; /* To cover the entire viewport */
            background-position: center; /* Center the image */
        }
        

a
{
    text-decoration: none;
    color: palevioletred;
    font-size: 28px;
}
	</style>
</head>
<body "margin:50px">
	<nav class="navbar">
		<div class="navdiv">
			<div class="logo" style="display: flex;align-items: center;margin-right: 10px;">
                <img src="logo.png" alt="Your Logo" style="width: 80px; height: 50px;">
                <h1 style="color: rgb(9, 167, 230);size: 5ch;">|</h1>
                <h1 style="color: rgb(9, 167, 230);">Course Court</h1>
            </div>
			
		</div>
        </nav>
    <br>
    <br>
    <h1> Managing the User Accounts</h1>

    <br>
    <table class="table">
        <thead>
            <tr class="bg-dark">
                            <th>First Name </th>
                            <th> Last Name</th>
                            <th>Date_of_birth </th>
                            <th>Email_id</th>
                            <th>User_id</th>
                            <th>Password</th>
                            <th>Action</th>
                   </tr>
        </thead>
        <tbody>
            <?php
             $db_host = 'localhost';
             $db_user = 'Educational_website';
             $db_password = 'Bannu@99;';
             $db_db = 'Educational_website';

             $conn = @new mysqli($db_host,$db_user,$db_password,$db_db);
      
           if (isset($_GET['User_id'])){
            $id=$_GET['User_id'];
           $sql2=mysqli_query($conn,"delete from Register_details where User_id='$id'");
         exit();
        }
           $sql1="select * from Register_details where usertype='user'";
           $result1=$conn->query($sql1);
           if(!$result1){
            die("Invalid query:".$conn->error);
        }
        while($row=$result1->fetch_assoc()){
            echo "<tr>
            <td>".$row["FirstName"]."</td>
            <td>".$row["LastName"]."</td>
            <td>".$row["Date_of_birth"]."</td>
            <td>".$row["Email_id"]."</td>
            <td>".$row["User_id"]."</td>
            <td>".$row["Password"]."</td>
            <td>
                <a href='users.php?User_id=".$row["User_id"]."' class='btn btn-primary'> Delete </a>
        </td>
        </tr>";
        }  
        ?>
</tbody>
    </table>
    </body>
</html>