<?php
session_start();
unset($_session['User_id']);
header("location:Registration.html");
?>