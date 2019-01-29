<?php 
$_SESSION['admin_id']   = '';
$_SESSION['admin_name'] = '';
$_SESSION['admin_mail'] = '';
sleep(1);
header('location: signin.php');
?>