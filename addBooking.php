<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
    <link rel="stylesheet" href="css/biciamiga.css" >
  </head>
		<body>

              <?php

              session_start();
              if(isset($_SESSION['type']))
                $_type = (string)$_SESSION['type'];
              if(isset($_SESSION['fullName']))
                $_fullName = (string)$_SESSION['fullName'];
              if(isset($_SESSION['dni'])){
                $_dni  = (int)$_SESSION['dni'];
              }
              else {header("Location:index.php");}
              ?>

              <?php


      //Save the values of the post.

        if (isset($_POST['submit'])) {

          $id = $_POST['id'];
          $dateFrom = $_POST['dateFrom'];
          $dateTo = $_POST['dateTo'];
          $typeBike = $_POST['typeBike'];
          if(isset($_type) && $_type == 1) //only admin can change the status of a booking
          $status = $_POST['status'];



          //validate the fields
          if (empty($dateFrom) || empty($dateTo) || empty($typeBike))
            $_errorValidacion = 1;
          else {
            if(isset($_GET['id'])) {
              include ("connection.inc");

                 $query = "UPDATE booking SET dateFrom='" . $dateFrom . "', dateTo='" . $dateTo . "', idTypeBike=" . $typeBike . ", status=" . $status. " where id=" . $_GET['id'];

                mysqli_query($link, $query) or die (mysqli_error($link));
                mysqli_close($link);

                $_errorValidacion = 0;
              }
              else {
                include ("connection.inc");
                

                require_once("stockValidator.php");

                if($dateTo < $dateFrom)
                    $_errorValidacion = 4;

                if(!isset($_errorValidacion) || $_errorValidacion == 0){
                    $validator = new StockValidator($typeBike, $dateFrom, $dateTo);

                    if ($validator->isAvailable()) {
                      $resultado = mysqli_query($link,"select price FROM biketype WHERE id = ".$typeBike);
                      $fila = $resultado->fetch_assoc();
                      if(isset($fila['price'])){
                        $bikePrice = $fila['price'];
                        $diff=date_diff(date_create($dateFrom),date_create($dateTo));
                          $totalPrice = ($diff->format("%a")+1) * $bikePrice;
                      }
                      else {
                        $totalPrice = 0;
                      }

                      $query = "INSERT INTO booking (idUser, dateFrom, dateTo, idTypeBike, status,totalPrice) VALUES ($_dni, '$dateFrom', '$dateTo', '$typeBike',1,$totalPrice);";
                      mysqli_query($link, $query) or die (mysqli_error($link));
                      mysqli_close($link);
                      $_errorValidacion = 0;

                    } else {
                        $_errorValidacion = 3;
                    }
              }

}
  
                     
              if(isset($_errorValidacion) &&  $_errorValidacion == 0)
                header("location:showBooking.php");

           }
        }
        else{
          include ("connection.inc");
          $resultado = mysqli_query($link,"select MAX(id) as max from booking");
          $fila = $resultado->fetch_assoc();
          if(isset($fila['max']))
          $id =$fila['max'] +1;
          else {
            $id = 1;
          }
        }

        ?>


        <div id="wrap">
      			<?php include("navBar.php") ?>
      <br>
      <br>
        <?php
  if (isset($_GET['id'])) {
    include ("connection.inc");
    $id = $_GET['id'];
    if ($resultado = $link->query('select booking.*, user.fullName as userName from booking  INNER JOIN user ON booking.idUser = user.dni where id =' . $id )) {
      $fila = $resultado->fetch_assoc();

       $dateFrom = $fila['dateFrom'];
       $dateTo = $fila['dateTo'];
       $typeBike = $fila['idTypeBike'];
       $status = $fila['status'];
       $userName = $fila['userName'];

       $modifica=1;

       if($status == 1){
         echo '<div class= "col-lg-12 text-center"><h3>Confirmar reserva</h3></div>';
       }
       elseif ($status == 2){
         echo '<div class= "col-lg-12 text-center"><h3>Finalizar reserva</h3></div>';
       }
    }
}
elseif (!isset($_POST['id'])){

  if(isset($_type) && $_type == 1)
    header("location:showBooking.php");

  
  echo '<div class= "col-lg-12 text-center"><h3>Nueva Reserva</h3></div>';
  $dateFrom = date('Y-m-d');
  $dateTo = date('Y-m-d');
  $status = 1;
}
  ?>


 <div class="container-fluid ">
  <div class = "col-lg-3"></div>
  <div class = "col-lg-6">
    <form name="submit" method="POST">

            <label class="control-label">Número de Reserva</label>
                  <input type="text" class="form-control" id="id" name="id" readonly   <?php  echo ' value="' . $id . '"'; ?>>
                  <?php 
                  if(isset($_type) && $_type == 1 && isset($userName))
                  echo '<label  class="control-label">Usuario</label>
                  <input class="form-control" id="userName" name="userName" readonly value="' . $userName . '"; >';
                  ?>
                  <label  class="control-label">Fecha Desde</label>
                  <input type="date" class="form-control" id="dateFrom" name="dateFrom" <?php  echo 'value="' . $dateFrom . '"'; ?>>

                  <label  class="control-label">Fecha Hasta</label>
                  <input type="date" class="form-control" id="dateTo" name="dateTo" <?php  echo 'value="' . $dateTo . '"'; ?>>

                  <label  class="control-label">Tipo de Bicicleta</label>
                  <div class="custom-select" >
                      <select id="typeBike" class="selection" name="typeBike" <?php if (isset($modifica) && $modifica == 1) echo 'value="'.$typeBike.'"' ?> >
                        <?php
                        include ("connection.inc");
                        $resultado = mysqli_query($link,"select * from biketype");
                        while ($row = mysqli_fetch_array($resultado)) {
                          echo '<option  value="'.$row['id'].'">'.$row['name'].' ($'.$row['price'].')</option>';
                        }
                                  ?>
                      </select>
                  </div>
                      <?php if(! isset($_type) || $_type == 1) { ?>
                  <label  class="control-label">Estado de la reserva</label>
                  <div class="custom-select" >
                      <select id="status" class="selection" name="status" <?php echo 'value="'.$status.'"'; if(! isset($_type) || $_type == 0) echo 'readonly'; ?> >
                          <?php
                          if(isset($status) && $status != 2)
                          echo'<option  value="1">Solicitada</option>'
                          ?>
                          <option  value="2">En curso</option>
                          <option  value="3">Finalizada</option>
                      </select>
                  </div>
                  <?php }

                     if (isset($_errorValidacion)){
                         if ($_errorValidacion == 1)
                           echo '<h4 class="alert alert-danger text-center">Ingrese todos los campos</h1>';
                         if ($_errorValidacion == 2)
                           echo '<h4 class="alert alert-danger text-center">El Número de Reserva ingresado no es valido</h1>';
                         if ($_errorValidacion == 3)
                           echo '<h4 class="alert alert-danger text-center">No hay stock disponible para esas fechas.</h1>';
                          if ($_errorValidacion == 4)
                           echo '<h4 class="alert alert-danger text-center">La fecha desde no puede ser mayor a la fecha hasta.</h1>';
                         if ($_errorValidacion == 0)
                           echo '<h4 class="alert alert-success text-center">La reserva se almacenó correctamente</h4>';
                      }

                     ?>

                          <button type="submit" name="submit" class="btn btn-primary col-lg-12 col-xs-12">Guardar</button>


    </form> <!-- End Form -->
 <div class="col-lg-3"></div>

  </div> <!-- Close div to form -->

  </div> <!-- End Container Fluid -->
 </div> <!-- End id Wrap -->

      <?php include("footer.php") ?>
		   <script src="jquery-1.10.2.min.js"></script>
       <script src="bootstrap.min.js"></script>
       <script src="bootswatch.js"></script>
    </body>
  </html>
