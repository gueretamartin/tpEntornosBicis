<?php
<<<<<<< HEAD
	include("connection.inc");
	$numberBooking = $_GET['numberBooking'];
	$link->query("delete from booking where numberBooking=" . $numberBooking);
	header("location:showBooking.php");
=======
include("connection.inc");
$numberBooking = $_GET['id'];
$link->query("delete from booking where id=" . $numberBooking);
header("location:showBooking.php");
>>>>>>> development
 ?>
