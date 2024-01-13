<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$mail = new PHPMailer(true);

if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "SELECT count(accID) AS ctr FROM tblusers WHERE email LIKE ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "s", $email_address);
	
	$email_address = $_POST['email'];
    str_replace("@","_",$email_address);
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr);
	while(mysqli_stmt_fetch($statement_check)){
		if($ctr > 0){
            $response["success"] = 1;
            $response["message"] = "Email already registered";
                die(json_encode($response));        
			exit();
		}
	}
	
}

$sql_insert = "INSERT INTO tblusers
            (email,
            username,
            password, 
            verificationCode
            )
            VALUES (?, ?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "ssss",
                    $email_address, $username, $password, $verficationCode);

                $email_address = $_POST['email'];
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $verficationCode = md5(uniqid());


        
				
				mysqli_stmt_execute($statement);
                                         
                $response["success"] = 1;
                $response["message"] = "Registered Successfully";
                die(json_encode($response));

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
                    $mail->Body = 'Please click the link to verify your Superphishal account <p> <a href="http://localhost/Activities/caps2/verify.php?vcode='.$verficationCode.'">Verify Your account here </a></p>';
                    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                    $mail->send();
                    echo "Mail has been sent successfully!";
                    ?>
                    <script>
                
                
            </script>
                    <?php
                    
                } catch (Exception $e) {
                $response["success"] = 1;
                $response["message"] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                die(json_encode($response));
                    
                }
            }

            else {
                $response["message"] = "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                die(json_encode($response));
                exit();
            }?>

            