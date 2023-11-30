<?php

$servername = "localhost:8889";
$username = "root";
$password = "root";
$db_name = "Database";

// Create connection
$conn = new mysqli($servername, $username, $password, $db_name, 8889);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
