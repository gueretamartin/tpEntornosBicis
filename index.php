<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>BiciAmiga Rosario - Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">

      <link rel="stylesheet" href="biciamiga.css" media="screen">

    <link rel="stylesheet" href="bootswatch.min.css">
    <link rel="stylesheet" type="text/css" href="footer.css">
		<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
		<link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

  </head>
		<body>
              <?php
              session_start();
              if (isset($_COOKIE['recordar'])){
                $_SESSION['fullName']=$_COOKIE['recordar'];
              }
              if(isset($_SESSION['fullName']))
                $_fullName = (string)$_SESSION['fullName'];
              ?>
  <div id="wrap">

    <?php include("navBar.php") ?>

<br>
<?php

	echo '<div><img src="img\BiciAmigaPortada.jpg" alt="BiciAmigaRosario"></div>';
  if (!isset($_fullName)) echo '
  <!-- Begin page content -->
      <div class="container text-center">

        <!--<div class="page-header text-center">
          <h1>BICIAMIGA</h1>
        </div>
        -->

        <!-- Services -->
      <section id="services">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 text-center">
              <h2 class="section-heading text-uppercase">¿Cómo funciona?</h2>
              <h3 class="section-subheading text-muted">Reserva tu Bicicleta en tres simples pasos.</h3>
            </div>
          </div>
          <div class="row text-center">
            <div class="col-md-4">
             <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-mouse-pointer fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 1</h4>
              <p class="text-muted">Hace click sobre el Botón<br><b>RESERVA TU BICI AHORA</b>.</p>
            </div>
            <div class="col-md-4">
              <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 2</h4>
              <p class="text-muted">Elegí el tipo de bicicleta y el rango de fechas que vas a usarla.</p>
            </div>
            <div class="col-md-4">
              <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-bicycle fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 3</h4>
              <p class="text-muted">Confirma tu reserva, imprimí tu ticket y acercate el dia acordado con tu ticket.</p>
            </div>
          </div>
        </div>
      </section>
        <br>

        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        <p class="lead well well-sm booking"><a href="newUser.php">REGISTRATE Y RESERVA TU BICI AHORA</a></>
        
<!--<p  class="lead well well-sm booking registrate"><a href="newUser.php"> REGISTRATE</a></>-->


</div>
<div class="col-lg-4"></div>';

else
  echo '<p class="lead well well-sm">Bienvenido <a href="myProfile.php">' . strtoupper($_fullName) . '</a>,  ' . '<a href="closeSession.php">cerrar sesión</a></p>';

    ?>
    </div><!-- Wrap Div end -->
</div>
        <?php include("footer.php") ?>
		    <script src="jquery-1.10.2.min.js"></script>
		    <script src="bootstrap.min.js"></script>
		    <script src="bootswatch.js"></script>
		</body>
	</html>
