<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>BiciAmiga</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="bootstrap.css" media="screen">
    <link rel="stylesheet" href="bootswatch.min.css">
    <link rel="stylesheet" type="text/css" href="footer.css">


<script type="text/javascript">
onload = function(){
 field = document.getElementById('body')
 field.onkeydown = keyhit
 field.focus()
}

function keyhit(e)
{
 thisKey = e ? e.which : window.event.keyCode
 switch (thisKey) {
  case 27: window.location.replace("index.php");
   break;
  default: key = null
 }

}
</script>


  </head>
		<body>

			<?php
include ("connection.inc");
if (isset($_POST['submit'])) {
	$vUsu = $_POST['usuario'];
	$vPass = md5($_POST['contraseña']);
	$vSql = "SELECT * FROM usuario WHERE dni ='$vUsu' AND password ='$vPass' ";
	$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));;
	$fila = mysqli_fetch_array($vResultado);
	if(mysqli_num_rows($vResultado) == 0) {
		 $_errorAutenticacion = 1;
	}
	else {
		$_usuario = $fila['user'];

		session_start();
  	$_SESSION['usuario'] =$_usuario;

  	if ($_POST['recordar'])
  	   setcookie("recordar", $_usuario, time() + 30*24*60*60);

		session_write_close();
		header("Location:index.php");

	}
	mysqli_close($link);
} ?>
<div id="wrap">
    <?php include("navbar.php") ?>
<br>
<br>
 <div class="container-fluid ">
 	<div class= "col-lg-12 text-center"> <h3>Ingresar</h3></div>
 	<div class = "col-lg-4"></div>
 	<div class = "col-lg-4">
 		 <form name="iniciarSesion" method="POST">
<div class="form-group row">
  <label for="example-text-input" class="col-2 col-form-label">Usuario</label>
  <div class="col-10">
    <input class="form-control" name = "usuario" type="text" id="example-text-input" placeholder="Ingrese su nombre de Usuario">
  </div>
</div>

<div class="form-group row">
  <label for="example-password-input" class="col-2 col-form-label">Password</label>
  <div class="col-10">
    <input class="form-control" type="password" name = "contraseña" id="example-password-input" placeholder="Ingrese su contraseña">
  </div>

<div class="form-group">
						   					<?php
						   					 if (isset($_errorAutenticacion))
						   						if ($_errorAutenticacion == 1)
						   						echo '<br><h4 class="text-danger">Usuario y/o contraseña  incorrecta.</h4>'; 
						   					?>
				              				<button type="submit" name="submit" class="btn btn-primary col-lg-6 col-xs-6 text-center ">Entrar</button>

			              				</div>	


</form>
</div>

  <div class="col-lg-4"></div>
</div>
		              <!-- Services -->
    <!--  <section id="sessions">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12 text-center">

		                   
		                        <div class="row text-center">
		                            <div class="col-md-4 col-md-offset-4 col-xs-10	 col-xs-offset-1 well" id="forminises">
		                            <h1 class="text-center">Iniciar sesion</h1>
										<div class="form-group">
									    	<label class="control-label">Usuario</label>
									    	<input type="text" class="form-control" name="usuario" placeholder="Usuario">
									    </div>
									    <div class="form-group">
									    	<label class="control-label">Contraseña</label>
									    	<input type="password" class="form-control" name="contraseña" placeholder="Contraseña">
			    							<div class="checkbox">
						    				<label>
						    					<input type="checkbox" name="recordar"> Recordar
						    				</label>
					    					</div>
						    			</div>
						   				<div class="form-group">
						   					<?php
						   					/* if (isset($_errorAutenticacion))
						   						if ($_errorAutenticacion == 1)
						   						echo '<h4 class="help-block text-danger text-center"><b>Usuario y/o contraseña  incorrecta.</b></h1><br>'; */
						   					?>
				              				<button type="reset" class="btn btn-warning col-lg-4 col-xs-5">Resetear</button>
				              				<button type="submit" name="submit" class="btn btn-primary col-lg-6 col-xs-6 pull-right">Entrar</button>

			              				</div>	 <div class="clearfix"></div>
		              				</div>
			              		</div>
		                    </form>
		                   </div>
		               </div>
		           </div>
		       </section> -->
		   </div>
    </div><!-- Wrap Div end -->


<?php include("footer.php") ?>


		    <script src="jquery-1.10.2.min.js"></script>
		    <script src="bootstrap.min.js"></script>
		    <script src="bootswatch.js"></script>
		</body>
	</html>