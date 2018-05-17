<?php
session_start();
unset($_SESSION['fullName']);
unset($_SESSION['dni']);
unset($_SESSION['type']);

setcookie("recordar", "", 0);
header("location:index.php");
?>
