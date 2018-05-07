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
    <?php
    session_start();
    if (isset($_COOKIE['recordar'])){
      $_SESSION['usuario'] = $_COOKIE['recordar'];
    }
    if(isset($_SESSION['usuario']))
      $_usuario = (string)$_SESSION['usuario'];
    ?>
  </head>
  <body>
    <div id="wrap">
      <?php include("barraNavegacion.php") ?>
 





      <?php include("pie.php") ?>
        <script src="jquery-1.10.2.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="bootswatch.js"></script>
    </body>
</html>