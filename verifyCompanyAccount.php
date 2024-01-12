<?php
include("connCheck.php");

if (@$_POST["action"] == "delete"){
	$sql_delete = "DELETE FROM tblusers WHERE email LIKE ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "s", $email_address);
		$email_address = $_POST["email"];
        str_replace("@","_",$email_address);

		mysqli_stmt_execute($delete_check);
        
    try {
        $mail->SMTPDebug = 2;									 
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
        $mail->Body = 'Your Superpishal account Registered under the email '.$email_address.' has been removed from the website under the authority of your company administrator. Please contact your company administrator for further details';
        $mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
        echo "Mail has been sent successfully!";
        ?>
        <script>
    
    
</script>
        <?php
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
		header("location: cadminDashboard.php");
		exit();
	}
 else{
    
$sql_update = "UPDATE tblusers SET status = ? WHERE email LIKE ?";

if ($statement = mysqli_prepare($conn, $sql_update)) {
    mysqli_stmt_bind_param($statement, "ss",
        $status, $email_address);

    $email_address = $_POST['email'];
    str_replace("@","_",$email_address);
    $status = "enabled";        
    
    mysqli_stmt_execute($statement);
    echo "Registered Successfully";
                             

    try {
        $mail->SMTPDebug = 2;									 
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
        $mail->Body = 'Please click the link to verify your Superphishal account <p> <a href="http://localhost/Activities/caps2/companyPortal.php">Login to your account here </a></p>';
        $mail->AltBody = 'Body in plain text for non-HTML mail clients';
        $mail->send();
        echo "Mail has been sent successfully!";
        ?>
        <script>
    
    
</script>
        <?php
        
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

else {
    echo "Unable to prepare query:". $sql_update . " " .mysqli_error($conn). "<br />";
    exit();
}

}

            