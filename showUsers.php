<!DOCTYPE html>
<html lang="es">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  	<link rel="stylesheet" type="text/css" href="footer.css"">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="bootstrap.css" media="screen">
  <link rel="stylesheet" href="bootswatch.min.css">
	
	<style type="text/css">
		@media only screen and (min-device-width : 100px){
			table p{
				font-size: 11px;
			}
			img{
				width:24px;
				height:24px;
				}
		}

		@media only screen and (min-width : 750px){
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
					if($_SESSION['type']=='1')
					{ 
			?>
				
<div id="wrap">
	<br>
		<h2 class="text-center">Administrador de Usuarios</h2>					
	<br>
		<?php include("navBar.php") ?>				
			<!-- Begin page content -->
				
	<div class="col-md-8 col-md-offset-2" >					
					<img  class="pull-right" src="img/nuevo.gif" alt="Nuevo" title="Nuevo"  onclick="newUser()" />
				<br><br>
				<div class="table-responsive">
				<table class="table table-striped table-hover text-center">
						<thead>
              <tr class="success">
                <th class="text-center"><p>D.N.I.</p></th>
                <th class="text-center"><p>Apelido y Nombre</p></th>
                <th class="text-center"><p>Email</p></th>
                <th class="text-center"><p>Tipo Usuario</p></th>
				<th class="text-center"><p>Estado</p></th>
                <th class="text-center"><p>Consultar</p></th>
                <th class="text-center"><p>Modificar</p></th>
                <th class="text-center"><p>Eliminar</p></th>
              </tr>
            </thead>
						<tbody>
							<?php 
								include ("connection.inc");
								$registros = 10;
								$contador = 1;

								if (!isset($_GET["pagina"])) {
								$inicio = 0;
								$pagina = 1;
								} else {
								$pagina = $_GET["pagina"];
								$inicio = ($pagina - 1) * $registros;
								}
								
								$resultados = mysqli_query($link,"select * from user");
								$total_registros = mysqli_num_rows($resultados);
								$resultados = mysqli_query($link,"select * from user LIMIT $inicio , $registros");
								$total_paginas = ceil($total_registros / $registros);
								
								if (isset($_fullName)){
									while ($fila = $resultados->fetch_assoc()){
                						echo '
											<tr class="active">
												<td><p>' . $fila['dni'] . '</p></td>
												<td><p>' . $fila['fullName'] . '</p></td>
												<td><p>' . $fila['email'] . '</p></td>';
												
												if($fila['type']=='1'){
													echo '<td><p>ADMINISTRADOR</p></td>';
												}else{
													echo '<td><p>CLIENTE</p></td>';
												}
												
												if($fila['status'] == '1'){
													echo '<td><p>HABILITADO</p></td>';
												}else{
													echo '<td><p>INHABILITADO</p></td>';
												}
												
												echo '<td>
																<img src="img/nuevo.gif" alt="Consultar" title="Consultar"  onclick="showUser(' . $fila['dni'] .  ')" /></td>
																<td><img src="img/modificar.gif" alt="Modificar" title="Modificar"  onclick="modifiedUser(' . $fila['dni'] .  ')" /></td>
																<td><img src="img/eliminar.gif" alt="Eliminar" title="Eliminar"  onclick="deleteUser(' . $fila['dni'] .  ',)"/></td>
															
														</tr>';
										$contador++;
                  }
                  mysqli_close($link);
                }
								
								echo '</tbody></table></div>';
								
								echo '    <div class="container col-lg-12 text-center">
                            <div class="row text-center">
												<ul class="pagination">';

                if (($pagina - 1) > 0){
									echo "<li><a href='showUsers.php?pagina=".($pagina-1)."'>«</a></li>";
								} else {
                	echo "<li><a>«</a></li>";
								}

								for ($i = 1; $i <= $total_paginas; $i++){
									if ($pagina == $i){
										echo '<li class="active"><a href="#">' . $pagina .'</a></li>';
									} else {
										echo '<li><a href="showUsers.php?pagina=' . $i . '">'.$i.'</a></li>';
									}
								}
								
								if (($pagina + 1)<=$total_paginas){
									echo "<li><a href='showUsers.php?pagina=" .($pagina+1)."'>»</a></li>";
								} else {
									echo '<li><a>»</a></li>';
								}
								echo '</ul></div></div></div>';
              ?>
						
				
										
			<?php 
					} else {
						header("Location:index.php");
					}
			?>			
	
			<?php include("footer.php") ?>	
			<script src="jquery-1.10.2.min.js"></script>
			<script src="bootstrap.min.js"></script>
			<script src="bootswatch.js"></script>

			<script type="text/javascript">
			function modifiedUser(idUser) {
					window.location.href = "showUser.php?mode=0&idUser=" + idUser;
			}
			
			function deleteUser(idUser,fullN) {
				window.location.href = "deleteUser.php?idUser=" + idUser;
			}
			
			function showUser(idUser) {
					window.location.href = "showUser.php?idUser=" + idUser;
			}
			
			function newUser() {
					window.location.href = "newUser.php";
			}
			
			function myFunction() {
					var txt;
					var r = confirm("Press a button!");
					if (r == true) {
							txt = "You pressed OK!";
					} else {
							txt = "You pressed Cancel!";
					}
					document.getElementById("demo").innerHTML = txt;
			}
			</script>	
			
		</body>

	</html>

