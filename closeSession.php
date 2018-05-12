<?php
session_start();
unset($_SESSION['fullName']);

setcookie("recordar", "", 0);

header("location:index.php");
?>
