<?php
session_start();
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$mid    = $_POST['mid'];
$name   = $_POST['name'];
$values = $_POST['values'];
$desc 	= $_POST['desc'];
$url 	= $_POST['url'];
	$up = "UPDATE $tbl_movie SET movie_name = '$name', movie_desc = '$desc', movie_url = '$url' WHERE movie_id = '$mid'";
	$ires = mysqli_query($con, $up);
	$del = "DELETE FROM  $tbl_moviecatrel WHERE  movie_id = '$mid'";
	$dres = mysqli_query($con, $del);
	for($i = 0; $i < count($values); $i++){
		$id = $values[$i];
		$sel = "SELECT movie_id FROM $tbl_moviecatrel WHERE movie_id = '$mid' AND cat_id = '$id' ";
		$sres = mysqli_query($con, $sel);
		if(mysqli_num_rows($sres) == 0){
			$ins = "INSERT INTO $tbl_moviecatrel (movie_id, cat_id) VALUES ('$mid','$id')";
			$ires = mysqli_query($con, $ins);
		}
	}
echo '1';
?>