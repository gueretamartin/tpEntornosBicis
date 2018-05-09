<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
   
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
   <!-- <link rel="stylesheet" type="text/css" href="footer.css">-->
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



        if (isset($_POST['submit'])) {
          $cuit = $_POST[ $_usuario];
          $calle = $_POST['calle'];
          $numero = $_POST['numero'];



          if (empty($cuit) || empty($calle) || empty($numero))
            $_errorValidacion = 1;
          else {
              include ("connection.inc");
              $resultado = $link->query('select * from booking where number =' . $cuit );
              $numrows = mysqli_num_rows($resultado);
              if ($numrows > 0) {
                $fila = $resultado->fetch_assoc();
                $query = "UPDATE edificio SET calle='" . $calle . "', numero=" . $numero . " where cuit=" . $cuit;
                mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;
              }
              else {
                $query = "INSERT INTO edificio VALUES (" . $cuit . ",'" . $calle . "'," . $numero . ")";
                mysqli_query($link, $query) or die (mysqli_error($link));
                $_errorValidacion = 0;
              }
              mysqli_close($link);
              header("location:consulta_edificios.php");

           }
        }

        ?>

        <?php
  if (isset($_GET['cuit'])) {
    include ("connection.inc");
    $cuit = $_GET['cuit'];
    if ($resultado = $link->query('select * from edificio where cuit =' . $cuit )) {
      $fila = $resultado->fetch_assoc();

    $calle = $fila['calle'];
    $numero = $fila['numero'];

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
                                  echo '<h1 class="text-center">Modificar Edificio</h1>';
                                  }
                                  else
                                    echo '<h1 class="text-center">Nuevo Edificio</h1>';
                               ?>
                  <div class="form-group">
                    <label class="control-label">Cuit</label>
                    <input type="text" class="form-control" id="cuit" name="cuit" placeholder="Cuit" <?php if (isset($modifica)) { if ($modifica == 1) echo 'value="' . $cuit . '"';} ?>>
                  </div>
                  <div class="form-group">
                    <label  class="control-label">Calle</label>
                    <input type="text" class="form-control" id="calle" name="calle" placeholder="Calle" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $calle . '"';} ?>>
                  </div>
                  <div class="form-group">
                    <label  class="control-label">Numero</label>
                    <input type="text" class="form-control" id="numero" name="numero" placeholder="Numero" <?php if (isset($modifica)) {if ($modifica == 1) echo 'value="' . $numero . '"';} ?>>
                  </div>
                   <div class="form-group">

                     <div id="mensajes">
                     <?php
                     if (isset($_errorValidacion))
					          {
                       if ($_errorValidacion == 1)
                       echo '<h4 class="alert alert-danger text-center">Ingrese todos los campos</h1>';
                       if ($_errorValidacion == 2)
                       echo '<h4 class="alert alert-danger text-center">El cuit ingresado no es valido</h1>';
					             if ($_errorValidacion == 0)
                       echo '<h4 class="alert alert-success text-center">El edificio ha sido ingresado correctamente</h4>';
					          }
                     ?>
                   </div>
                     <br>
                          <button type="reset" class="btn btn-warning col-lg-4 col-xs-5">Resetear</button>

                          <button type="button"   onclick="validaCuit();" class="btn btn-primary col-lg-6 col-xs-6 pull-right">Agregar</button>
                          <button type="submit" name="submit" id="btnsub" style="display:none"></button>


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

        function validaCuit() {

            if (validaCampos()){
            sCuit = document.getElementById("cuit").value;
            var aMult = '5432765432';
            var aMult = aMult.split('');
            if (sCuit && sCuit.length == 11)
            {

                aCUIT = sCuit.split('');
                var iResult = 0;
                for(i = 0; i <= 9; i++)
                {
                    iResult += aCUIT[i] * aMult[i];
                }
                iResult = (iResult % 11);
                iResult = 11 - iResult;
                if (iResult == 11) iResult = 0;
                if (iResult == 10) iResult = 9;
                if (iResult == aCUIT[10])
                {

                      document.getElementById('btnsub').click();
                      return true;}

            }
            document.getElementById("mensajes").innerHTML = '<h4 class="alert alert-danger text-center">El cuit ingresado no es valido</h1>';
            return false;}
        }
        </script>
		</body>
	</html>
