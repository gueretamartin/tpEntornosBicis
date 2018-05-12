<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
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

                 $query = "UPDATE booking SET dateFrom='" . $dateFrom . "', dateTo='" . $dateTo . "', idTypeBike=" . $typeBike . ", status=" . $state. " where id=" . $_GET['numberBooking'];

                mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;
              }
              else {
                include ("connection.inc");
                $query = "INSERT INTO booking (idUser, dateFrom, dateTo, idTypeBike, status) VALUES ('$_usuario', '$dateFrom', '$dateTo', '$typeBike',1);";
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
    if ($resultado = $link->query('select * from booking where id =' . $numberBooking )) {
      $fila = $resultado->fetch_assoc();

       $dateFrom = $fila['dateFrom'];
       $dateTo = $fila['dateTo'];
       $typeBike = $fila['idTypeBike'];
       $state = $fila['status'];

    $modifica=1;
}}
  ?>

  <div id="wrap">
			<?php include("navBar.php") ?>
<br>
<br>
 <div class="container-fluid ">
   <div class= "col-lg-12 text-center"><h3> <?php if (isset($modifica)) {
                                if ($modifica == 1)
                                  echo 'Modificar Reserva';
                                  }
                                  else
                                    echo 'Nueva Reserva';
                               ?></h3></div>
  <div class = "col-lg-3"></div>
  <div class = "col-lg-6">
    <form name="submit" method="POST">

            <label class="control-label">Número de Reserva</label>
                    <input type="text" class="form-control" id="numberBooking" name="numberBooking" readonly="readonly" <?php if (isset($modifica)) { if ($modifica == 1) echo ' value="' . $numberBooking . '"';} ?>>
                
                    <label  class="control-label">Fecha Desde</label>
                    <input type="date" class="form-control" id="dateFrom" name="dateFrom" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $dateFrom . '"';} ?>>
               
                    <label  class="control-label">Fecha Hasta</label>
                    <input type="date" class="form-control" id="dateTo" name="dateTo" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $dateTo . '"';} ?>>
                    
                    <label  class="control-label">Tipo de Bicicleta</label>
                    <div class="custom-select" >
                        <select id="typeBike" class="selection" name="typeBike">
                          <option  <?php if (isset($modifica)) {if ($typeBike == 0) echo 'selected="selected"' ;}?> value="0">Playera</option>
                          <option  <?php if (isset($modifica)) {if ($typeBike == 1) echo 'selected="selected"' ;}?> value="1">Doble</option>
                          <option <?php if (isset($modifica)) {if ($typeBike == 2) echo 'selected="selected"' ;}?>  value="2">MountainBike</option>
                        </select>
                      </div>                
              
                    <label  class="control-label">Estado</label>
                      <div class="custom-select" >
                        <select id="state" class="selection" name="state"  readonly="readonly">
                          <option  <?php if (isset($modifica)) {if ($state == 1) echo 'selected="selected" ';}?> value="1"> Activa</option>
                           <option  <?php if (isset($modifica)) {if ($state == 0) echo 'selected="selected"';}?> value="0"> Inactiva</option>
                         </select>
                      </div>

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
 <button type="reset" class="btn btn-warning col-lg-4 col-xs-5">Resetear</button>

                          <button type="submit" name="submit" class="btn btn-primary col-lg-6 col-xs-6 pull-right">Agregar</button>


    </form> <!-- End Form -->
 <div class="col-lg-3"></div>

  </div> <!-- Close div to form -->

  </div> <!-- End Container Fluid -->
 </div> <!-- End id Wrap -->

<?php include("footer.php") ?>

		    <script src="jquery-1.10.2.min.js"></script>
		    <script src="bootstrap.min.js"></script>
		    <script src="bootswatch.js"></script>


       <!-- <script>

        function validaCampos(){

          if ((document.getElementById("calle").value.length == 0) || (document.getElementById("numero").value.length == 0)){
              document.getElementById("mensajes").innerHTML = '<h4 class="alert alert-danger text-center">Complete todos los campos</h1>';
              return false;}
          else {
              return true;
          }

        }
        </script>-->
		</body>
	</html>
