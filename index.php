<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Bici Amiga Rosario - Reserva de Bicicletas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
    <link rel="stylesheet" type="text/css" href="footer.css">

     <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
  <div id="wrap">

    <?php include("barraNavegacion.php") ?>

<br>
<?php 
  if (!isset($_usuario)) echo '
  <!-- Begin page content -->
      <div class="container text-center">

        <!--<div class="page-header text-center">
          <h1>BICIAMIGA</h1>
        </div>
        -->
        <div>
          <img src="img\BiciAmigaPortada.jpg" alt="BiciAmigaRosario">
        </div>

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
              <p class="text-muted">Hace click sobre el Botón "RESERVA TU BICI AHORA".</p>
            </div>
            <div class="col-md-4">
              <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-pencil-square-o fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 2</h4>
              <p class="text-muted">Completa con tus datos. Elegí el tipo de bicicleta, la fecha y la cantidad de horas que vas a usarla.</p>
            </div>
            <div class="col-md-4">
              <span class="fa-stack fa-4x">
                <i class="fa fa-circle fa-stack-2x text-primary"></i>
                <i class="fa fa-bicycle fa-stack-1x fa-inverse"></i>
              </span>
              <h4 class="service-heading">PASO 3</h4>
              <p class="text-muted">Confirma tu reserva, imprimí tu ticket y estarás listo para usar tu Bici el día elegido!</p>
            </div>
          </div>
        </div>
      </section>
        <br>
<p class="lead well well-sm"><a href="iniciarsesion.php">RESERVA TU BICI AHORA</a></p>';
else
  echo '<p class="lead well well-sm">Bienvenido ' . strtoupper($_usuario) . ',  ' . '<a href="cerrarsesion.php">cerrar sesión</a></p>';
    ?>
    </div><!-- Wrap Div end -->
</div>

<?php include("pie.php") ?>

		    <script src="jquery-1.10.2.min.js"></script>
		    <script src="bootstrap.min.js"></script>
		    <script src="bootswatch.js"></script>
		</body>
	</html>
