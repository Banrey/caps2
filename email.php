<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
	$mail->SMTPDebug = false;									 
	$mail->isSMTP();										 
	$mail->Host	 = 'smtp.gmail.com;';				 
	$mail->SMTPAuth = true;							 
	$mail->Username = 'superphishalteam@gmail.com';				 
	$mail->Password = 'chzc akbv ndop mloz';					 
	$mail->SMTPSecure = 'tls';							 
	$mail->Port	 = 587; 

	$mail->setFrom('superphishalteam@gmail.com', 'rene');		 
	$mail->addAddress($email_address);
	
	$mail->isHTML(true);								 
	$mail->Subject = 'Account Verification';
	$mail->Body = 'Your Admin account for Superphishal has been validated. Please click the link to enter the Login page <p> <a href="http://localhost/Activities/caps2/cAdminLogin.php?vcode='.$verificationCode.'">Verify Your account here </a></p>';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
