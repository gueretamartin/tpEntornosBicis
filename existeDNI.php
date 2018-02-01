<?php
$dni = $_POST["dni"];
require("connection.php");
$sql = "SELECT dni FROM usuarios where dni = '$dni'" ;
$result=$mysqli->query($sql);
$row = $result->fetch_assoc();
//Asigno 1 si existe el usuario
//Asigno 0 si no existe (el nombre de usuario está disponible)
if($row > 0 ){
  $respuesta['res'] = 1;
} else { $respuesta['res'] = 0;}	
    mysqli_close($mysqli);
    echo json_encode($respuesta);
 ?>
