<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $FirstName=$_POST['FirstName'];
    $LastName=$_POST['LastName'];
    $Date_of_birth=$_POST['Date_of_birth'];
    $Email_id=$_POST['Email_id'];
    $User_id=$_POST['User_id'];
    $Password=$_POST['Password'];
    $Dte_of_birth = date_create($date_of_birth);


  $db_host = 'localhost';
  $db_user = 'Educational_website';
  $db_password = 'Bannu@99;';
  $db_db = 'Educational_website';

 
  $conn = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db,
  );
    if($conn->connect_error){
        die('Connection Failed:'.$conn->connect_error);
    }
    else{
      if (empty($FirstName) || empty($LastName)|| empty($Date_of_birth) || empty($Email_id) || empty($User_id) || empty($Password)) {
        echo "All fields are required.";
    }
        $stmt=$conn->prepare("Insert into Register_details(FirstName,LastName,Date_of_birth,Email_id,User_id,Password)values(?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $FirstName, $LastName, $Date_of_birth,$Email_id, $User_id, $Password);
        if ($stmt->execute()) {
       
          echo '<script>alert("Registration Successful.Try to login to the System"); window.location = "Registration.html";</script>';
                  
          } else {
           
              echo "Error: " . $stmt->error;
          }
        }
        $stmt->close();
      $conn->close();
}
        
  ?>