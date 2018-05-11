<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
	   
	    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <link rel="stylesheet" href="bootstrap.css" media="screen">
	    <link rel="stylesheet" href="bootswatch.min.css">
			<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
			<style>
			#map {
				height: 350px;
				width: 100%;
			}
			</style>
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
		
		<?php include("navBar.php") ?>
		<div id="wrap">
			<br>			
			<h2 align="center">¡Acercate a nuestro local!</h2>
			<br>
			<div class="container-fluid text-center">								 	
				<div class="container">
					<div id="map"></div>
				</div>
			</div>
		</div>
		<?php include("footer.php") ?>		
		
		<script src="initmap.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBy52O248NVTAreNPSQnH_Khbt7pYI-go&callback=initMap"></script>  
	 	</body>
</html>
