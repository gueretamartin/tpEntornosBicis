<!DOCTYPE html>
<html lang="es">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <title>BiciAmiga Rosario - Galeria</title>
  <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="bootstrap.css" media="screen">
  <link rel="stylesheet" href="bootswatch.min.css">
  <link rel="stylesheet" type="text/css" href="footer.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
   <?php
    session_start();
    if (isset($_COOKIE['recordar'])){
      $_SESSION['usuario']=$_COOKIE['recordar'];
    }
    if(isset($_SESSION['usuario']))
      $_usuario = (string)$_SESSION['usuario'];
    ?>

  <?php include("navBar.php") ?>
  <div class="container text-center">
    <div class="row">
      <div class="col-lg-12 text-center">
        <h2 class="section-heading text-uppercase">Nuestras Bicis</h2>
        <h3 class="section-subheading text-muted">¡Elige el diseño que más te guste!</h3>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-6">
        <img src="img/portfolio/playera/playera_th_1.jpg" class="bike" alt="">
        <div>
          <h4>Playera</h4>
          <p class="text-muted">Bicicleta de paseo. Simple y cómoda.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <img src="img/portfolio/mountain/mountain_th_1.jpg" class="bike" alt="">
        <div>
          <h4>Mountain Bike</h4>
          <p class="text-muted">Bicicleta deportiva. Más ligera.</p>
        </div>
      </div>
      <div class="col-md-4 col-sm-6">
        <div>
         <img src="img/portfolio/doble/doble_th_1.jpg" class="bike" alt="">
         <h4>Doble</h4>
         <p class="text-muted">Bicicleta para compartir.</p>
       </div>
     </div>
   </div>
  <div class="col-lg-4"></div>
        <div class="col-lg-4">
<p class="lead well well-sm booking"><a href="startSession.php">RESERVA TU BICI AHORA</a></p>
</div>
<div class="col-lg-4"></div>
 </div>
 <?php include("footer.php") ?>
</body>

</html>
