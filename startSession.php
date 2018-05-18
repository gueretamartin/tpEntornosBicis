<!DOCTYPE html>
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>BiciAmiga Rosario - Iniciar Sesión</title>
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="bootstrap.css" media="screen">
	<link rel="stylesheet" href="bootswatch.min.css">
	<link rel="icon" href="img/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
	<script type="text/javascript">
	/* function keyhit(e)
		{
			thisKey = e ? e.which : window.event.keyCode
			switch (thisKey) {
				case 27: window.location.replace("index.php");
				break;
				default: key = null
			}
		}*/
	</script>
</head>
<body>

	<?php
	include ("connection.inc");
	if (isset($_POST['submit'])) {
		$vUsu = $_POST['usuario'];
		$vPass = md5($_POST['contraseña']);
		$vSql = "SELECT * FROM user WHERE dni ='$vUsu' AND password ='$vPass' ";
		$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));;
		$fila = mysqli_fetch_array($vResultado);
		if($fila['status']==0) {header("Location:error.php");mysqli_close($link);$rdo=1;};
		if(mysqli_num_rows($vResultado) == 0) {
			$_errorAutenticacion = 1;
		}
		else if(!isset($rdo)) {
			$_fullName = $fila['fullName'];
			$_type = $fila['type'];
			$_dni = $fila['dni'];
			$_phone = $fila['phone'];
			$_email = $fila['email'];
			$_status = $status['status'];
	
			session_start();
	
			$_SESSION['fullName'] = $_fullName;
			$_SESSION['type'] = $_type;
			$_SESSION['dni'] = $_dni;
			$_SESSION['phone'] = $_phone;
			$_SESSION['email'] = $_email;
			$_SESSION['status'] = $_status;
			if ($_POST['recordar'])
				setcookie("recordar", $_fullName, time() + 30*24*60*60);
			session_write_close();
			header("Location:index.php");
		}
		mysqli_close($link);
	} ?>
	<div id="wrap">
		<?php include("navBar.php") ?>
		<br>
		<br>
		<div class="container-fluid ">
			<div class= "col-lg-12 text-center"><h3>Ingresar</h3></div>
			<div class = "col-lg-3"></div>
			<div class = "col-lg-6">
				<form name="startSession" method="POST">
					<div class="form-group row">
						<?php
							if (isset($_errorAutenticacion))
								if ($_errorAutenticacion == 1)
									echo '<div align="center"><h4 class="text-danger">¡Usuario y/o contraseña incorrecta!</h4></div>';
						?>
						<label for="example-text-input" class="col-2 col-form-label">D.N.I.</label>
						<div class="col-10">
							<input class="form-control" name = "usuario" type="number" min="1" max="999999999999" id="usuario" required>
						</div>
						<label for="example-password-input" class="col-2 col-form-label">Contraseña</label>
						<div class="col-10">
							<input class="form-control" type="password" name = "contraseña" id="contraseña" required>
						</div>
						<div align="right">
							<label>
								<input type="checkbox" name="recordar">&nbsp;&nbsp;Recordar mi sesión
							</label>
						</div>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary col-lg-12 col-xs-12 text-center" style="margin-top:0;">Entrar</button>
						</div>
					</form>
					<br>
					<div align="center" style="margin-top:2rem;">
						<a class="signUp" href="newUser.php">Aún no estoy registrado</a>
					</div>
				</div>
					<div class="col-lg-3"></div>
			</div>
			</div>
		</div><!-- Wrap Div end -->
		<?php include("footer.php") ?>
		<script src="jquery-1.10.2.min.js"></script>
		<script src="bootstrap.min.js"></script>
		<script src="bootswatch.js"></script>
	</body>
	</html>
