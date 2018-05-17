  <!DOCTYPE html>
  <html lang="es">
		<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<meta charset="utf-8">
			<title>BiciAmiga Rosario - Mi Cuenta</title>
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
				$_SESSION['fullName']=$_COOKIE['recordar'];
			}
			else { header("Location: index.php");}
			if(isset($_SESSION['fullName']))
				$_fullName = (string)$_SESSION['fullName'];

			if (isset($_POST['submit'])) {
				$fullName = $_POST['fullName'];
				$dni = $_SESSION['dni'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];

				if(isset($_POST['chk']))
				{
					$password = $_POST['password'];
					$cambia = true;
				}
				else
					$cambia = false;

				if (empty($fullName) || empty($email) || empty($dni))
					$_errorValidacion = 1;
				else {
					include ("connection.inc");
					$resultado = mysqli_query($link, 'select * from user where dni ='.$dni.';');
					if (mysqli_num_rows($resultado) == 0) {
						$_errorValidacion = 1;
					}
					else {
						if($cambia){
							$vPass=md5($password);
							// los strings tienen que ir entre comillas -sidaaa
							$query = "UPDATE user SET fullName='$fullName', email='$email', phone='$phone', password='$vPass' WHERE dni=$dni";
							mysqli_query($link, $query) or die (mysqli_error($link));
							$_errorValidacion = 0;
						}
						else{
							$query = "UPDATE user SET fullName='$fullName', email='$email', phone='$phone' WHERE dni=$dni";
							mysqli_query($link, $query) or die (mysqli_error($link));
							$_errorValidacion = 0;
						}
					}
					mysqli_close($link);

					$_SESSION['fullName'] = $fullName;
					$_SESSION['phone'] = $phone;
					$_SESSION['email'] = $email;
				}
			}


			?>
			<div id="wrap">
				<?php include("navBar.php") ?>
				<br>
				<!-- new -->
				<div class="container-fluid ">
					<div class= "col-lg-12 text-center">
						<h3>Mi Cuenta</h3>
					</div>
					<div class = "col-lg-3"></div>
					<div class = "col-lg-6">
						<form action="myProfile.php" method="POST">
							<div class="form-group row">
								<?php
								if (isset($_errorValidacion))
								{
									if ($_errorValidacion == 1)
										echo '<h4 class="alert alert-danger text-center">¡Ha ocurrido un problema!</h1>';
									if ($_errorValidacion == 0)
										echo '<h4 class="alert alert-success text-center">¡Modificación exitosa!</h4>';
								}
								?>
								<label class="control-label">DNI</label>
								<input type="number" max="999999999999" min="1" value="<?php echo $_SESSION['dni']?>" class="form-control" id="dniAux" name="dniAux" disabled>
								<label class="control-label">Apellido y Nombre</label>
								<input type="text" class="form-control" id="fullName" name="fullName" maxlength="80" value="<?php echo (string)$_SESSION['fullName']?>" required>
								<label class="control-label">Teléfono</label>
								<input type="text" maxlength="40" class="form-control" id="phone" name="phone" required value="<?php echo $_SESSION['phone']?>">
								<label class="control-label">Email</label>
								<input type="email" maxlength="100" class="form-control" id="email" name="email" required value="<?php echo $_SESSION['email']?>">
								<fieldset>
									<legend>&nbsp;<input type="checkbox" id="chk" name="chk" onclick="enableDisable(this.checked)">&nbsp;¿Cambia contraseña?&nbsp;&nbsp;</legend>
										<label class="control-label">Nueva contraseña</label>
										<input type="password" class="form-control" disabled="true" id="password"  name="password">
										<label class="control-label">Repita nueva contraseña</label>
										<input type="password" class="form-control" disabled="true" id="repass" name="repass">
								</fieldset>
							</div>
							<div class="form-group row" style="margin-top: 0;">
								<button type="button" class="btn btn-warning col-lg-5 col-md-5 col-xs-12 pull" onclick="window.open('index.php','_self')">Volver al Inicio</button>
								<button type="submit" name="submit" id="submit" class="btn btn-primary col-lg-5 col-md-5 col-xs-12 pull-right">Modificar datos</button>
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
			<script src="editUser.js"></script>
		</body>
	</html>
