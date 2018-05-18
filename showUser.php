
  <!DOCTYPE html>
  <html lang="es">
		<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
			<title>BiciAmiga Rosario - Consulta Usuario</title>
			<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
			<meta http-equiv="X-UA-Compatible" content="IE=edge">
			<link rel="stylesheet" href="bootstrap.css" media="screen">
			<link rel="stylesheet" href="bootswatch.min.css">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="icon" href="img/favicon.ico" type="image/x-icon">
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
		</head>
		<body>
			<?php
			session_start();
			if (isset($_COOKIE['recordar'])){
				$_SESSION['fullName']=$_COOKIE['recordar'];
			}
			if(isset($_SESSION['fullName']))
				$_fullName = (string)$_SESSION['fullName'];

			if(isset($_POST['submit'])){				
				include ("connection.inc");
				$_dni = $_POST['dniAux'];
				$fullName = $_POST['fullName'];
				$email = $_POST['email'];
				$phone = $_POST['phone'];
				$type = $_POST['type'];
				$status = $_POST['status'];
				
				// los strings tienen que ir entre comillas -sidaaa
				$query = "UPDATE user SET fullName='$fullName', email='$email', phone='$phone', type=$type, status=$status  WHERE dni=$_dni";
				mysqli_query($link, $query) or die (mysqli_error($link));
				mysqli_close($link);
				header("Location:showUsers.php");
			} else{
				if (isset($_GET['idUser'])) {
					include ("connection.inc");
					$vDni = $_GET['idUser'];
					$vSql = "SELECT * FROM user WHERE dni ='$vDni'";			
					$vResultado = mysqli_query($link, $vSql) or die (mysqli_error($link));;
					$vFila = mysqli_fetch_array($vResultado);
					if(mysqli_num_rows($vResultado) == 0) {
						header("Location:index.php");
					}
					else{
						$_fullName = $vFila['fullName'];
						$_type = $vFila['type'];
						$_dni = $vFila['dni'];
						$_phone = $vFila['phone'];
						$_email = $vFila['email'];
						$_status = $vFila['status'];
					}
					
					$edit = false;
					if(isset($_GET["mode"])){
						$edit = true;
					}
				}
				else{
					header('Location:index.php');
				}				
			}
			?>
			<div id="wrap">
				<?php include("navBar.php") ?>
				<br>
				<!-- new -->
				<div class="container-fluid ">
					<div class= "col-lg-12 text-center">
						<h3>
						<?php 
						if($edit)
						{ echo 'Modifica'; } 
						else { echo 'Consulta'; }
						?> Usuario</h3>
					</div>
					<div class = "col-lg-3"></div>
					<div class = "col-lg-6">
						<form action="showUser.php" method="POST">
							<div class="form-group row">
								<label class="control-label">DNI</label>
								<input type="number" max="999999999999" min="1" value="<?php echo $_dni?>" class="form-control" id="dniAux" name="dniAux" readonly>
								<label class="control-label">Apellido y Nombre</label>
								<input type="text" class="form-control" id="fullName" name="fullName" maxlength="80" value="<?php echo (string)$_fullName?>" 
								<?php
									if($edit){
										echo 'required';
									} else {
										echo 'readonly';
									}
								?>>
								<label class="control-label">Teléfono</label>
								<input type="text" maxlength="40" class="form-control" id="phone" name="phone" value="<?php echo $_phone?>"
								<?php
									if($edit){
										echo 'required';
									} else {
										echo 'readonly';
									}
								?>>
								<label class="control-label">Email</label>
								<input type="email" maxlength="100" class="form-control" id="email" name="email" value="<?php echo $_email?>"
								<?php
									if($edit){
										echo 'required';
									} else {
										echo 'readonly';
									}
								?>>
								<label class="control-label">Tipo de Usuario:</label>
								<select id="type" name="type" class="col-lg-12 selection"
								<?php
									if($edit){
										echo 'required';
									} else {
										echo 'disabled';
									}
								?>>
									<option value="1" 
									<?php 
										if($_type=='1')
											echo 'selected'
									?>>ADMINISTRADOR</option>
									<option value="0" 
									<?php 
										if($_type=='0')
											echo 'selected'
									?>>CLIENTE</option>
								</select><br>																
								<label class="control-label">Estado:</label>
								<select id="status" name="status" class="col-lg-12 selection" 
								<?php
									if($edit){
										echo 'required';
									} else {
										echo 'disabled';
									}
								?>>
									<option value="1" 
									<?php 
										if($_status=='1')
											echo 'selected';
									?>>HABILITADO</option>
									<option value="0" 
									<?php 
										if($_status=='0')
											echo 'selected';
									?>>INHABILITADO</option>
								</select>
							</div>
							<div class="form-group row" style="margin-top: 0;">
								<?php
									if($edit){
										echo '<button type="submit" name="submit" id="submit" class="btn btn-primary col-lg-12 col-md-12 col-xs-12 pull-right">Modificar</button>';
									} else {
										echo '<button type="button" name="button" id="button" class="btn btn-primary col-lg-12 col-md-12 col-xs-12 pull-right" onclick="volver()">Aceptar</button>';
									}
								?>
								
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
			<link rel="stylesheet" href="css/biciamiga.css" >
			<script>
			function volver(){
				window.open("showUsers.php","_self");
			}
			</script>
		</body>
	</html>
