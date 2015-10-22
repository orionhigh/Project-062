<?php
session_start();
if(isset($_SESSION['user'])!="")
{
	header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$uname = mysql_real_escape_string($_POST['uname']);
	$email = mysql_real_escape_string($_POST['email']);
	$upass = md5(mysql_real_escape_string($_POST['pass']));
	$hash = md5( rand(0,1000) );

	if(mysql_query("INSERT INTO users (username, password, email, hash) VALUES(
'". mysql_escape_string($uname) ."', 
'". mysql_escape_string($upass) ."', 
'". mysql_escape_string($email) ."', 
'". mysql_escape_string($hash) ."') "))
	{
		?>
        <script>alert('Your account has been made, please verify it by clicking the activation link that has been sent to your email.');</script>
        <?php
		//SMTP needs accurate times, and the PHP time zone MUST be set
		//This should be done in your php.ini, but this is how to do it if you don't have access to that
		date_default_timezone_set('Etc/UTC');

		require 'phpmailer/PHPMailerAutoload.php';

		//Create a new PHPMailer instance
		$mail = new PHPMailer;

		//Tell PHPMailer to use SMTP
		$mail->isSMTP();

		//Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;

		//Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		//Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';
		// use
		// $mail->Host = gethostbyname('smtp.gmail.com');
		// if your network does not support SMTP over IPv6

		//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		//Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		//Whether to use SMTP authentication
		$mail->SMTPAuth = true;

		//Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = "cab202group62@gmail.com";

		//Password to use for SMTP authentication
		$mail->Password = "bigpassword";

		//Set who the message is to be sent from
		$mail->setFrom('vault62@gmail.com', 'Alex Woodcroft');

		//Set an alternative reply-to address
		$mail->addReplyTo('newvoxel@gmail.com.com', 'Alex Woodcroft');

		//Set who the message is to be sent to
		$mail->addAddress($email, $uname);

		//Output the email with html tags
		$mail->isHTML(true);  

		//Set the subject line
		$mail->Subject = 'Signup | Verification';

		//Read an HTML message body from an external file, convert referenced images to embedded,
		//convert HTML into a basic plain-text alternative body
		$mail->Body    = "<p>Thanks for signing up!<br />
						Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.</p>
						
						<p>	 
						------------------------<br />
						Username: ".$uname."<br />
						------------------------<br />
						</p>
						
						<p>
						Please follow this link to activate your account: http://localhost/verify.php?email=" . $email . "&hash=" . $hash . "
						</p>";


		//send the message, check for errors
		if (!$mail->send()) {
		    echo "Mailer Error: " . $mail->ErrorInfo;
		}


	}
	else
	{
		?>
        <script>alert('Error while registering you...');</script>
        <?php
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
<div id="login-form">
<form method="post">
<table align="center" width="30%" border="0">
<tr>
<td><input type="text" name="uname" placeholder="User Name" required /></td>
</tr>
<tr>
<td><input type="email" name="email" placeholder="Your Email" required /></td>
</tr>
<tr>
<td><input type="password" name="pass" placeholder="Your Password" required /></td>
</tr>
<tr>
<td><button type="submit" name="btn-signup">Sign Me Up</button></td>
</tr>
<tr>
<td><a href="index.php">Sign In Here</a></td>
</tr>
</table>
</form>
</div>
</center>
</body>
</html>