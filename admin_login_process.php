<?php
include("db_config.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adminUsername = $_POST["username"];
    $adminPassword = $_POST["password"];

    // Fetch admin details from the admin table based on the entered username
    $sql = "SELECT * FROM admin WHERE Username = '$adminUsername'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if ($adminPassword == $row["Password"]) {
            $_SESSION["adminUsername"] = $adminUsername;
            // Redirect to admin.php after successful login
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Admin not found";
    }
}
?>