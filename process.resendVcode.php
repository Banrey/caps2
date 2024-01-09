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


$sql_check = "SELECT COUNT(accID) AS ctr, 
    verificationCode
FROM 
    tblusers 
WHERE   
    email = ?" ;
    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "s", $email);
        
        $email = $_POST['email'];
        mysqli_stmt_execute($statement_check);
        
        mysqli_stmt_bind_result($statement_check, $ctr, $verficationCode);
        while(mysqli_stmt_fetch($statement_check)){
            if($ctr >= 1){
                try {
                    $mail->SMTPDebug = 2;									 
                    $mail->isSMTP();										 
                    $mail->Host	 = 'smtp.gmail.com;';				 
                    $mail->SMTPAuth = true;							 
                    $mail->Username = 'renegerardcordura@gmail.com';				 
                    $mail->Password = 'xhpt mwvq plza cajp';					 
                    $mail->SMTPSecure = 'tls';							 
                    $mail->Port	 = 587; 

                    $mail->setFrom('renegerardcordura@gmail.com', 'rene');		 
                    $mail->addAddress($_POST['email']);
                    
                    $mail->isHTML(true);								 
                    $mail->Subject = 'Account Verification';
                    $mail->Body = 'HTML message body in <p> <a href="http://localhost/Activities/caps2/verify.php?vcode='.$verficationCode.'">Verify Your account here </a></p>';
                    $mail->AltBody = 'Body in plain text for non-HTML mail clients';
                    $mail->send();
                    echo "Mail has been sent successfully!";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                
               
            }  else{
                header("location: resendVcode.php?account=notExist");
            }
        }
    }

                
            ?>