<?php 

session_start();

$_SESSION['admin_id'] = null;
$_SESSION['admin_email'] = null;
$_SESSION['admin_nama'] = null;

header("Location: login.php");






?>