<?php
session_start();
unset($_SESSION['ADMIN_LOGIN']);
unset($_SESSION['ADMIN_EMAIL']);
unset($_SESSION['ADMIN_PASSWORD']);
header('location:home.php');
die();
?>