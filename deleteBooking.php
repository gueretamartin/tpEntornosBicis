<?php
include("conexion.inc");
$cuit = $_GET['cuit'];
$link->query("Delete From edificio where Cuit=" . $cuit);
header("location:consulta_edificios.php");
 ?>
