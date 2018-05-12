<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
		<title>BiciAmiga Rosario - Reserva</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
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

              <?php


      //Save the values of the post.

        if (isset($_POST['submit'])) {
          //$user = $_SESSION[$_usuario];
        //  $numberBooking = $_POST['numberBooking'];
          $dateFrom = $_POST['dateFrom'];
          $dateTo = $_POST['dateTo'];
          $typeBike = $_POST['typeBike'];
          $state = 1;


          //validate the fields
          if (empty($state) || empty($dateFrom) || empty($dateTo) || empty($typeBike))
            $_errorValidacion = 1;
          else {  
            if(isset($_GET['numberBooking'])) {
              include ("connection.inc");

                 $query = "UPDATE booking SET dateFrom='" . $dateFrom . "', dateTo='" . $dateTo . "', typeBike='" . $typeBike . "', state=" . $state. " where numberBooking=" . $_GET['numberBooking'];

                mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;
              }
              else {
                include ("connection.inc");
                $query = "INSERT INTO booking (user, dateFrom, dateTo, typeBike, state) VALUES ('$_usuario', '$dateFrom', '$dateTo', '$typeBike',1);";
                mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;
              }
              mysqli_close($link);
              header("location:showBooking.php");

           }
        }

        ?>

        <?php
  if (isset($_GET['numberBooking'])) {
    include ("connection.inc");
    $numberBooking = $_GET['numberBooking'];
    if ($resultado = $link->query('select * from booking where numberBooking =' . $numberBooking )) {
      $fila = $resultado->fetch_assoc();

       $dateFrom = $fila['dateFrom'];
       $dateTo = $fila['dateTo'];
       $typeBike = $fila['typeBike'];
       $state = $fila['state'];

    $modifica=1;
}}
  ?>

  <div id="wrap">
			<?php include("navBar.php") ?>
<br>
<br>


  <!-- Begin page content -->
  <div class="container">
    <div class="container">
            <div class="row">
                <div class="col-lg-12 col-xs-12">
                    <form name="addEdificio" method="POST">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 col-xs-10	 col-xs-offset-1 well" id="forminises">
                              <?php if (isset($modifica)) {
                                if ($modifica == 1)
                                  echo '<h1 class="text-center">Modificar Reserva</h1>';
                                  }
                                  else
                                    echo '<h1 class="text-center">Nueva Reserva</h1>';
                               ?>
                  <div class="form-group">
                    <label class="control-label">Número de Reserva</label>
                    <input type="text" class="form-control" id="numberBooking" name="numberBooking" readonly="readonly" <?php if (isset($modifica)) { if ($modifica == 1) echo ' value="' . $numberBooking . '"';} ?>>
                  </div>
                  <div class="form-group">
                    <label  class="control-label">Fecha Desde</label>
                    <input type="date" class="form-control" id="dateFrom" name="dateFrom" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $dateFrom . '"';} ?>>
                  </div>
                  <div class="form-group">
                    <label  class="control-label">Fecha Hasta</label>
                    <input type="date" class="form-control" id="dateTo" name="dateTo" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $dateTo . '"';} ?>>
                  </div>
                  <div class="form-group">
                    <label  class="control-label">Tipo de Bicicleta</label>
                    <input type="text" class="form-control" id="typeBike" name="typeBike" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $typeBike . '"';} ?>>
                  </div>
                  <div class="form-group">
                    <label  class="control-label">Estado</label>
                    <input type="text" class="form-control" id="state" name="state" readonly="readonly" value ="1"  <?php if (isset($modifica)) {if ($modifica == 1) echo ' value="' . $state . '"';} ?>>
                  </div>
                   <div class="form-group">

                     <div id="mensajes">
                     <?php
                     if (isset($_errorValidacion))
					          {
                       if ($_errorValidacion == 1)
                       echo '<h4 class="alert alert-danger text-center">Ingrese todos los campos</h1>';
                       if ($_errorValidacion == 2)
                       echo '<h4 class="alert alert-danger text-center">El Número de Reserva ingresado no es valido</h1>';
					             if ($_errorValidacion == 0)
                       echo '<h4 class="alert alert-success text-center">La reserva se ah almacenado correctamente</h4>';
					          }
                     ?>
                   </div>
                     <br>
                          <button type="reset" class="btn btn-warning col-lg-4 col-xs-5">Resetear</button>

                          <button type="submit" name="submit" class="btn btn-primary col-lg-6 col-xs-6 pull-right">Agregar</button>
                  
<div class="clearfix"></div>
                      </div>
                    </div>
                    </div>
                    </form>

            </div>
    </div>

  </div>
</div><!-- Wrap Div end -->



</div>
<?php include("footer.php") ?>

		    <script src="jquery-1.10.2.min.js"></script>
		    <script src="bootstrap.min.js"></script>
		    <script src="bootswatch.js"></script>


        <script>

        function validaCampos(){

          if ((document.getElementById("calle").value.length == 0) || (document.getElementById("numero").value.length == 0)){
              document.getElementById("mensajes").innerHTML = '<h4 class="alert alert-danger text-center">Complete todos los campos</h1>';
              return false;}
          else {
              return true;
          }

        }

        
        </script>
		</body>
	</html>
