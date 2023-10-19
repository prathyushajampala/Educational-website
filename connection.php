<?php
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
    if($db)
    {
       if($conn->connect_error){
        die('Connection Failed:'.$conn->connect_error);
    }
    }
?>