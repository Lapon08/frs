<?php 

session_start();

$_SESSION['user_username'] = null;
$_SESSION['user_email'] = null;
$_SESSION['user_firstname'] = null;
$_SESSION['user_lastname'] = null;
$_SESSION['user_role'] = null;
$_SESSION['user_id'] = null;

header("Location: ../login.php");






?>