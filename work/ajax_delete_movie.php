<?php
session_start();
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$mid    = $_POST['mid'];
	$del = "DELETE FROM $tbl_movie WHERE  movie_id = '$mid'";
	$dres = mysqli_query($con, $del);
	$del1 = "DELETE FROM  $tbl_moviecatrel WHERE  movie_id = '$mid'";
	$dres = mysqli_query($con, $del1);
	$del2 = "DELETE FROM  $tbl_moviecrew  WHERE  movie_id = '$mid'";
	$dres = mysqli_query($con, $del2);
echo '1';
?>