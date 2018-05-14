<?php
include("connection.inc");
$numberBooking = $_GET['id'];
$link->query("delete from booking where id=" . $numberBooking);
header("location:showBooking.php");
 ?>
