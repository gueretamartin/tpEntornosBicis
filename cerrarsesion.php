<?php
session_start();
unset($_SESSION['usuario']);

setcookie("recordar", "", 0);

header("location:index.php");
?>