  <!DOCTYPE html>
  <html lang="es">
		<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta charset="utf-8">
			<title>BiciAmiga Rosario - Registrarse</title>
			<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="stylesheet" href="bootstrap.css" media="screen">
			<link rel="stylesheet" href="bootswatch.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="icon" href="img/favicon.ico" type="image/x-icon">
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
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
	 
			if (isset($_POST['submit'])) {
				$fullName = $_POST['fullName'];
				$dni = $_POST['dni'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$password = $_POST['password'];
				if (empty($fullName) || empty($email) || empty($password) || empty($dni)) 
					$_errorValidacion = 1;
				else {
					include ("connection.inc");
					$resultado = mysqli_query($link, 'select * from usuario where dni ='.$dni.';');
					if (mysqli_num_rows($resultado) > 0) {
						$_errorValidacion = 1;
					}
					else {
						$vPass=md5($password);
						// los strings tienen que ir entre comillas -sidaaa
						$query = "INSERT INTO usuario (fullName, dni, email, phone, password, type) VALUES ('$fullName', $dni, '$email', '$phone','$vPass', 0);";
						mysqli_query($link, $query) or die (mysqli_error($link));
						$_errorValidacion = 0;
						header("location:index.php");
					}
					mysqli_close($link);
				}
			}
			?>
			<div id="wrap">
				<?php include("navBar.php") ?>
				<br>
				<!-- new -->
				<div class="container-fluid ">
					<div class= "col-lg-12 text-center">
						<h3>Nuevo Usuario</h3>
					</div>
					<div class = "col-lg-3"></div>
					<div class = "col-lg-6">
						<form action="newUser.php" method="POST">
							<div class="form-group row">
								<div id="mensajes">
								 <?php
								 if (isset($_errorValidacion))
								 {
									 if ($_errorValidacion == 1)
										 echo '<h4 class="alert alert-danger text-center">Ya existe un usuario con ese DNI</h1>';
									 if ($_errorValidacion == 0)
										 echo '<h4 class="alert alert-success text-center">Usuario creado con éxito</h4>';
								 }
								 ?>
								</div>
								<label class="control-label">DNI</label>
								<input type="number" max="999999999999" min="1" class="form-control" id="dni" name="dni" required>
								<label class="control-label">Apellido y Nombre</label>
								<input type="text" class="form-control" id="fullName" name="fullName" maxlength="80" required >
								<label class="control-label">Teléfono</label>
								<input type="text" maxlength="40" class="form-control" id="phone" name="phone" >
								<label class="control-label">Email</label>
								<input type="email" maxlength="100" class="form-control" id="email" name="email" required >
								<label class="control-label">Contraseña</label>
								<input type="password" class="form-control" id="password" name="password" required>
								<label class="control-label">Repita Contraseña</label>
								<input type="password" class="form-control" id="repass" name="repass" required >
							</div>
							<div class="form-group row" style="margin-top: 0;">
								<button type="reset" class="btn btn-warning col-lg-5 col-md-5 col-xs-12 pull" onclick="clearFields();">Limpiar campos</button>
								<button type="submit" name="submit" id="submit" class="btn btn-primary col-lg-5 col-md-5 col-xs-12 pull-right">Registrarse</button>
							</div>
							<div class="clearfix"></div> 
						</form>
					</div>
					<div class="col-lg-3"></div>
				</div>
			</div>
			<?php include("footer.php") ?>
			<script src="jquery-1.10.2.min.js"></script>
			<script src="bootstrap.min.js"></script>
			<script src="bootswatch.js"></script>
			<script src="newUser.js"></script>
		</body>
	</html>