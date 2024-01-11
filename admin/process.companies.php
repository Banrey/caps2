<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

$mail = new PHPMailer(true);



if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete"){
	$sql_delete = "DELETE FROM tblcompanyadmin WHERE cadminID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["cadminID"];
		mysqli_stmt_execute($delete_check);
		header("location: companies.php");
		exit();
	}
}
	else{
		$sql_check = "UPDATE tblcompanyadmin SET status = ? WHERE cadminID = ? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "si", $status, $id);
			
			$status = $_POST['status'];
			$id = $_POST['cadminID'];
            $email = $_POST['email'];
            $verificationCode = $_POST['verificationCode'];
			mysqli_stmt_execute($statement_check);

            if ($status == "enabled"){
                      
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
	$mail->addAddress($email);
	
	$mail->isHTML(true);								 
	$mail->Subject = 'Account Verification';
	$mail->Body = 'Please click the link to verify your Superphishal account <p> <a href="http://localhost/Activities/caps2/verify.php?vcode='.$verificationCode.'">Verify Your account here </a></p>';
	$mail->AltBody = 'Body in plain text for non-HTML mail clients';
	$mail->send();
	echo "Mail has been sent successfully!";
} catch (Exception $e) {
	echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
            }

      
        
		}
	}

