<?php
require("connection.php");

if(!empty($_POST))
{
  $name = mysqli_real_escape_string($mysqli,$_POST['inputName']);
  $dni = mysqli_real_escape_string($mysqli,$_POST['inputDNI']);
  $date = mysqli_real_escape_string($mysqli,$_POST['inputDate']);
  $tel = mysqli_real_escape_string($mysqli,$_POST['inputTel']);
  $mail = mysqli_real_escape_string($mysqli,$_POST['inputEmail']);
  $password = mysqli_real_escape_string($mysqli,$_POST['Password']);
  $password2 = mysqli_real_escape_string($mysqli,$_POST['inputPassword2']);
  $sha1_pass = sha1($password);
  $error = '';
  $habilitado = true;
  
   $sql2 = "INSERT INTO usuarios (apenom,email,pass,dni,habilitado,fec_alta,fec_ult_log,es_administrador,nro_contacto) VALUES ('$name','$mail','$$sha1_pass','$dni',1,NOW(),NOW(),0,'$tel')";
   $result1=$mysqli->query($sql2);

   header("location: registroExitoso.html");
};
 ?>