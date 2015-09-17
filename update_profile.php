<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
$user = $_SESSION['user'];
include_once 'dbconnect.php';

if(isset($_POST['Update']))
{
	$uname = mysql_real_escape_string($_POST['username']);
	$email = mysql_real_escape_string($_POST['email']);
	if($_POST['password'] != "Update Password") {
		$upass = md5(mysql_real_escape_string($_POST['password']));
		mysql_query("UPDATE users SET username = '$uname',email = '$email',password = '$upass' WHERE user_id = '$user'");
	} else {
		mysql_query("UPDATE users SET username = '$uname',email = '$email' WHERE user_id = '$user'");
	}
}
header("Location: home.php#profile");
?>
	