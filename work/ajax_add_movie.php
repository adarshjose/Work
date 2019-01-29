<?php
session_start();
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$name   = $_POST['name'];
$values = $_POST['values'];
$desc 	= $_POST['desc'];
$url 	= $_POST['url'];
$sel = "SELECT movie_id FROM $tbl_movie WHERE movie_name = '$name' AND movie_status = 'active' AND movie_url = '$url' ";
$sres = mysqli_query($con, $sel);
if(mysqli_num_rows($sres) == 0){
	$ins = "INSERT INTO $tbl_movie (movie_name, movie_desc, movie_url, movie_status) VALUES ('$name','$desc','$url','active')";
	$ires = mysqli_query($con, $ins);
	$movieid = mysqli_insert_id($con);
	for($i = 0; $i < count($values); $i++){
		$id = $values[$i];
		$sel = "SELECT movie_id FROM $tbl_moviecatrel WHERE movie_id = '$movieid' AND cat_id = '$id' ";
		$sres = mysqli_query($con, $sel);
		if(mysqli_num_rows($sres) == 0){
			$ins = "INSERT INTO $tbl_moviecatrel (movie_id, cat_id) VALUES ('$movieid','$id')";
			$ires = mysqli_query($con, $ins);
		}
	}
	echo $movieid;
}else{
	echo 'Movie Already Exists';
}

?>