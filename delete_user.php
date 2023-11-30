<?php
include("db_config.php");
session_start();

// Check if admin is logged in
if (!isset($_SESSION["adminUsername"])) {
    header("Location: adminlogin.php");
    exit();
}

// Check if the user ID is provided in the URL
if (isset($_GET["user_id"])) {
    $userID = $_GET["user_id"];

    // Delete the user from the register_details table
    $sqlDeleteUser = "DELETE FROM register_details WHERE User_id = '$userID'";

    if ($conn->query($sqlDeleteUser) === TRUE) {
        echo "User deleted successfully!";
        header("Refresh: 2; URL=admin_manage_user.php");
        exit();
    } else {
        echo "Error deleting user: " . $conn->error;
    }
} else {
    echo "User ID not provided.";
    exit();
}
?>
