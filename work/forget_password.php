<?php
session_start();
include('config.php');
include('db.php');
$connection = new connectDB();
$con = $connection->connect();
$errmsg = $mail = '';
if(isset($_POST['submit'])){
	$mail = $_POST['mail'];
	$sel = "SELECT admin_id FROM $tbl_admin WHERE admin_status = 'active' AND admin_email = '$mail' ";
	$res = mysqli_query($con, $sel);
	if(mysqli_num_rows($res) > 0){
		$to = "somebody@example.com, somebodyelse@example.com";
		$subject = "Your New Password For Product Name";
		$npass = rand(10,10);
		$message = "
		<html>
		<body>
		<h2>Password Reset For Product Name</h2>
		<p>Your New Password For The Product Name is".$npass." </p>
		</body>
		</html>
		";
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: <productname@productname.com>' . "\r\n";
		$headers .= 'Cc: info@productname.com' . "\r\n";
		@mail($to,$subject,$message,$headers);
		$upd = "UPDATE  $tbl_admin SET admin_pass = '$npass' WHERE admin_email = '$mail' ";
		$ures = mysqli_query($con, $sel);
		header('location: movie_list.upd');
	}else{
		$errmsg = 'Mail Not Exists in Our Database. Try Signup';
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
				<h3>Reset Password</h3>
				<h5 class="error-message"><?=$errmsg?></h5>
			</div>
			<div class="email-w3l">
			<span class="i1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
				<input class="email" type="email" name="mail" value="<?=$mail?>" placeholder="Enter Email" required>
			</div>
			<div>
				<p class="p-style">We will send a Temporary Password to this Mail Address</p>
			</div>
			<div class="form-check">
				<div class="left">
					<a href="signup.php">Or <span class="a-span">Sign up</span> here</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="submit-agileits">
				<input class="login" type="submit" name="submit" value="Send Mail">
			</div>
		</form>
	</div>
</div>
</body>
</html>