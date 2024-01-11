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
	$mail->Body = 'Please click the link to verify your Superphishal account <p> <a href="http://localhost/Activities/caps2/verify.php?vcode='.$_GET['verificationCode'].'">Verify Your account here </a></p>';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>