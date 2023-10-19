<?php
  include 'connection.php';
  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
    $User_id=$_POST["User_id"];
    $Password=$_POST["Password"];
  
  
  $query="Select * from Register_details where (User_id='$User_id' AND Password='$Password')" ;
  $result=mysqli_query($conn,$query);
  $row=mysqli_fetch_array($result);
   if($row["usertype"]=="user" AND $result->num_rows>0)
   {
    $rt=mysqli_fetch_assoc($result);
    $User_id=$rt['User_id'];
    $_SESSION['User_id']=$User_id;
  
   
    header("Location:home.html");
    //login 
   }
   elseif($row["usertype"]=="admin"AND $result->num_rows==1)
   {
    header("Location:admin.html");
    exit;
  
    //login 
   }
   else{
    echo '<script>alert("Invalid credentials. Please try again."); window.location = "Registration.html";</script>';
    
   
  }
  }
   
  
   $conn->close();

?>