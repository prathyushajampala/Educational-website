<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category=$_POST['category'];
    $description=$_POST['description'];
    


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
      if (empty($category) || empty($description)) {
        echo "All fields are required.";
    }
        $stmt=$conn->prepare("Insert into Queries(category,description)values(?,?)");
        $stmt->bind_param("ss", $category, $description);
        echo"connection sucessful";
        if ($stmt->execute()) {
              header('Location:Queries.html');
          } else {
              echo "Error: " . $stmt->error;
          }
        }
        $stmt->close();
      $conn->close();
}
        
  ?>