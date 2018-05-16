<!DOCTYPE html>
<html lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	    <meta charset="utf-8">
			<title>BiciAmiga Rosario - Contacto</title>
	    <meta name="viewport" content="width=device-width, initial-scale=1 , maximum-scale=1, user-scalable=no">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <link rel="stylesheet" href="bootstrap.css" media="screen">
	    <link rel="stylesheet" href="bootswatch.min.css">
			<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
			<link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
			<link rel="icon" href="img/favicon.ico" type="image/x-icon">
			<link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
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
      $_SESSION['fullName']=$_COOKIE['recordar'];
    }
    if(isset($_SESSION['fullName']))
      $_fullName = (string)$_SESSION['fullName'];
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
		<script src="jquery-1.10.2.min.js"></script>
		<script src="bootstrap.min.js"></script>
		 <script src="bootswatch.js"></script>
		<script src="initmap.js"></script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCBy52O248NVTAreNPSQnH_Khbt7pYI-go&callback=initMap"></script>
	 	</body>
	 		
</html>
