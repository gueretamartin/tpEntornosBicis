<!DOCTYPE html>
<html lang="es">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="bootstrap.css" media="screen">
  <link rel="stylesheet" href="bootswatch.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="footer.css">-->
	
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
				
				
				<div class="col-md-8 col-md-offset-2 text-right" >					
					<img src="img/nuevo.gif" alt="Nuevo" title="Nuevo"  onclick="newUser()" />
				</div>
				
				<br>	
				<br>
				<div class="col-md-8 col-md-offset-2">		
				<table class="table table-striped table-hover text-center">
						<thead>
              <tr class="success">
                <th class="text-center"><p>D.N.I.</p></th>
                <th class="text-center"><p>Apelido y Nombre</p></th>
                <th class="text-center"><p>Email</p></th>
                <th class="text-center"><p>Tipo Usuario</p></th>
								<th class="text-center"><p>Estado</p></th>
                <th class="text-center"><p></p></th>
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
												
												if($fila['status']=='1'){
													echo '<td><p>HABILITADO</p></td>';
												}else{
													echo '<td><p>INHABILITADO</p></td>';
												}
												
												echo '<td>
																<img src="img/nuevo.gif" alt="Consultar" title="Consultar"  onclick="consultUser(' . $fila['dni'] .  ')" />
																<img src="img/modificar.gif" alt="Modificar" title="Modificar"  onclick="modifiedUser(' . $fila['dni'] .  ')" />
																<img src="img/eliminar.gif" alt="Eliminar" title="Eliminar"  onclick="deleteUser(' . $fila['dni'] .  ')" />
															</td>
														</tr>';
										$contador++;
                  }
                  mysqli_close($link);
                }
								
								echo '</tbody></table>';
								
								echo '<div class="col-lg-10 col-lg-offset-5 col-md-10 col-md-offset-5 col-xs-10 col-xs-offset-2">
												<ul class="pagination col-xs-10 col-md-10 col-lg-10">';

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
								echo '</ul></div>';
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
					window.location.href = "consultUser.php?mode=0&idUser=" + idUser;
			}
			
			function deleteUser(idUser) {
					window.location.href = "deleteUser.php?idUser=" + idUser;
			}
			
			function consultUser(idUser) {
					window.location.href = "consultUser.php?idUser=" + idUser;
			}
			
			function newUser() {
					window.location.href = "newUser.php";
			}
			
			$('#confirm-delete').on('show.bs.modal', function(e) {
					$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
					$cadena =  $(this).find('.btn-ok').attr('href') + "*";

					$numberBooking = $cadena.substring($cadena.indexOf("numberBooking=")+5, $cadena.indexOf("&date"));
					$date = $cadena.substring($cadena.indexOf("date=")+6, $cadena.indexOf("&typeBike"));
					$typeBike = $cadena.substring($cadena.indexOf("&typeBike=")+8, $cadena.indexOf("*"));

					$('.numberBooking').html($numberBooking);
					$('.date').html('¿Desea eliminar el edificio ' + $date + ' ' + $typeBike + '?');
			});
			</script>	
			
		</body>

	</html>

