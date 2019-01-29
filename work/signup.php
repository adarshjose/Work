<?php
session_start();
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$name = $pass = $errmsg = $mail = '';
if(isset($_POST['submit'])){
	$name = $_POST['name'];
	$pass = $_POST['pass'];
	$mail = $_POST['mail'];
	$sel = "SELECT admin_id FROM $tbl_admin WHERE admin_status = 'active' AND admin_name = '$name' AND admin_pass = '$pass' AND admin_email = '$mail' ";
	$res = mysqli_query($con, $sel);
	if(mysqli_num_rows($res) == 0){
		$ins = "INSERT INTO $tbl_admin (admin_name, admin_pass, admin_email, admin_status) VALUES ('$name','$pass','$mail','active') ";
		$ires = mysqli_query($con, $ins);
		$adminid = mysqli_insert_id($con);
		$_SESSION['admin_id'] = $adminid;
		$_SESSION['admin_name'] = $name;
		$_SESSION['admin_mail'] = $mail;
		header('location: movie_list.php');
	}else{
		$errmsg = 'Data Already Exists !';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?=$title?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> 
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
	function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="css/signin-style.css" rel="stylesheet" type="text/css" media="all"><!--style_sheet-->
<link href="css/signin-font-awesome.min.css" rel="stylesheet" type="text/css" media="all"><!--font_awesome_icons-->
<link href="//fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800,900&amp;subset=latin-ext" rel="stylesheet">
</head>
<body>
<div class="form">
	<div class="form-content">
		<form action="#" method="post">
			<div class="form-info">
				<h3>Signup To Product Name</h3>
				<h5 class="error-message"><?=$errmsg?></h5>
			</div>
			<div class="email-w3l">
				<span class="i1"><i class="fa fa-user" aria-hidden="true"></i></span>
				<input class="email" type="text" name="name" value="<?=$name?>" placeholder="Enter Name" required>
			</div>
			<div class="pass-w3l">
			<span class="i2"><i class="fa fa-unlock" aria-hidden="true"></i></span>
				<input class="pass" type="password" name="pass" value="<?=$pass?>" placeholder="Enter Password" required>
			</div>
			<div class="email-w3l">
			<span class="i1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
				<input class="email" type="email" name="mail" value="<?=$mail?>" placeholder="Enter Email" required>
			</div>
			<div class="form-check">
				<div class="left">
					<a href="signin.php">or <span class="a-span">Sign in</span></a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="submit-agileits">
				<input class="login" type="submit" name="submit" value="Signup">
			</div>
		</form>
	</div>
</div>
</body>
</html>