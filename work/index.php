<?php 
session_start();
if(!isset($_SESSION['admin_id'])){
	header('location: signin.php');
}else{
	header('location: movie_list.php');
}