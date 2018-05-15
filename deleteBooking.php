<?php
	include("connection.inc");
	$numberBooking = $_GET['numberBooking'];
	$link->query("delete from booking where numberBooking=" . $numberBooking);
	header("location:showBooking.php");
 ?>
