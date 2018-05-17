<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
   
    <style type="text/css">
    @media only screen
    and (min-device-width : 100px) {
    table p{
      font-size: 11px;
    }
    img{
      width:24px;
      height:24px;
    }
    }

    @media only screen
    and (min-width : 750px) {
    table  p{
        font-size: 16px;
      }
      img{
        width:24px;
        height:24px;
      }
    }
     </style>


  </head>
		<body>
              <?php
              session_start();
              if (isset($_COOKIE['recordar'])){
                $_SESSION['fullName']=$_COOKIE['recordar'];
              }
              if(isset($_SESSION['fullName']))
                $_fullName = (string)$_SESSION['fullName'];
              if(isset($_SESSION['type'])){
                $_type = $_SESSION['type'];
              } 
              else {
                header("Location: index.php");
              }
              
              ?>
  <div id="wrap">
			    <?php include("navBar.php") ?>
<br>
  <!-- Begin page content -->


              <?php
include ("connection.inc");
              $registros = 6;
              $contador = 1;

              if (!isset($_GET["pagina"])) {
              $inicio = 0;
              $pagina = 1;
              } else {
              $pagina = $_GET["pagina"];
              $inicio = ($pagina - 1) * $registros;
              }

              $resultados = mysqli_query($link,"select * from booking");
              $total_registros = mysqli_num_rows($resultados);
              $where = '';
              if($_type==0){$where=" where u.dni = " . $_SESSION['dni'] . " ";}
              $query = "select booking.*,biketype.name,u.fullName from booking inner join biketype on booking.idTypeBike = biketype.id inner join user as u on u.dni = booking.idUser " . $where . " LIMIT $inicio , $registros";
              $resultados = mysqli_query($link,$query);
              $total_registros = mysqli_num_rows($resultados);
              $total_paginas = ceil($total_registros / $registros);

              if($total_registros!=0){
                echo '<div class="col-md-8 col-md-offset-2">
          <div class="table-responsive">
          <table class="table table-striped table-hover text-center">
            <thead>
              <tr class="success">
                <th class="text-center"><p>Número de Reserva</p></th>
                <th class="text-center"><p>Usuario</p></th>
                <th class="text-center"><p>Fecha Desde</p></th>
                <th class="text-center"><p>Fecha Hasta</p></th>
                <th class="text-center"><p>Tipo de Bicicleta</p></th>
                <th class="text-center"><p>Precio</p></th>
                <th class="text-center"><p>Estado</p></th>';
                
                if(isset($_type) && $_type == 1){
                echo '<th class="text-center"><p>Modificar</p></th>
                <th class="text-center"><p>Eliminar</p></th>';
                }

                       echo'       </tr>
            </thead>
              <tbody>';

                if (isset($_fullName)){

                    while ($fila = $resultados->fetch_assoc()) {
                    echo '
                    <tr class="active">
                      <td><p>' . $fila['id'] . '</p></td>
                      <td><p>' . $fila['fullName'] . '</p></td>
                      <td><p>' . $fila['dateFrom'] . '</p></td>
                      <td><p>' . $fila['dateTo'] . '</p></td>
                      <td><p>' . $fila['name'] . '</p></td>
                      <td><p>' . $fila['totalPrice'] . '</p></td>';

                      if($fila['status'] == 1)
                        echo '<td><p>Solicitada</p></td>';
                      elseif($fila['status'] == 2)
                        echo '<td><p>En curso</p></td>';
                      elseif($fila['status'] == 3)
                        echo '<td><p>Finalizada</p></td>';
                            if(isset($_type) && $_type == 1)
                      echo '<td><img src="img/modificar.gif" alt="Modificar" title="Modificar"  onclick="modifiedBooking(' . $fila['id'] .  ')" /></td>

                      <td><img src="img/eliminar.gif" alt="Eliminar" title="Eliminar" data-href="deleteBooking.php?id=' . $fila['id']. '" data-toggle="modal" data-target="#confirm-delete")"/></td>
                    </tr>
                    ';
                  $contador++;
                  }

                  mysqli_close($link);
                }
                  echo '</tbody></table></div>';
                  echo '<div class="container col-lg-12 text-center">
                    <div class="row text-center">
                    <a href="addBooking.php" class="btn btn-primary">Nueva Reserva</a>
                            </div>

                  <div class="row text-center">
                  <ul class="pagination">';

                  if (($pagina - 1) > 0) {
                      echo "<li><a href='showBooking.php?pagina=".($pagina-1)."'>«</a></li>";
                	} else {
                	echo "<li><a>«</a></li>";
                	}

                  for ($i = 1; $i <= $total_paginas; $i++) {
                  if ($pagina == $i) {
                  echo '<li class="active"><a href="#">' . $pagina .'</a></li>';
                  } else {
                  echo '<li><a href="showBooking.php?pagina=' . $i . '">'.$i.'</a></li>';
                  }
                  }
                  if (($pagina + 1)<=$total_paginas) {
                  echo "<li><a href='showBooking.php?pagina=" .($pagina+1)."'>»</a></li>";
                  } else {
                  echo '<li><a>»</a></li>';
                  }
                  echo '</ul></div></div>'; }
                  else echo '<div class="container col-lg-12 text-center">
                    <div class="row text-center">  </div><h1>No hay reservas disponibles</h1></div>
                    <div class="row text-center"> 
                    <a href="addBooking.php" class="btn btn-primary">Nueva Reserva</a> </div>'

              ?>
</div>


          <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Confirmar eliminación</h4>
            </div>

            <div class="modal-body">


                  <div class="date"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-danger btn-ok">Borrar</a>
            </div>
        </div>
    </div>
</div>
    </div><!-- Wrap Div end -->
		   


        <script type="text/javascript">
        function modifiedBooking(id) {
            window.location.href = "addBooking.php?id=" + id;
        }
        </script>

        <script type="text/javascript">
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            $cadena =  $(this).find('.btn-ok').attr('href') + "*";

            $id = $cadena.substring($cadena.indexOf("id=")+5, $cadena.indexOf("&date"));
            $date = $cadena.substring($cadena.indexOf("date=")+6, $cadena.indexOf("&idTypeBike"));
            $idTypeBike = $cadena.substring($cadena.indexOf("&idTypeBike=")+8, $cadena.indexOf("*"));

            $('.id').html($id);
            $('.date').html('¿Desea eliminar el edificio ' + $date + ' ' + $idTypeBike + '?');

        });
        </script>

      <?php include("footer.php") ?>
		    <script src="jquery-1.10.2.min.js"></script>
        <script src="bootstrap.min.js"></script>
        <script src="bootswatch.js"></script>
    </body>
</html>
