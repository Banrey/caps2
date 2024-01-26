<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "SELECT count(cadminID) AS ctr FROM tblcompanyadmin WHERE email LIKE ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "s", $email_address);
	
	$email_address = $_POST['email_address'];
    str_replace("@","_",$email_address);
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr);
	while(mysqli_stmt_fetch($statement_check)){
		if($ctr > 0){
            echo "Email already registered";           
            header("location: companyRegistration.php?account=registered");
			exit();
		}
	}
	
}


$sql_insertAdmin = "INSERT INTO tblcompanyadmin
            (email,
            username,
            password,
            verificationCode
            )
            VALUES (?, ?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insertAdmin)) {
                mysqli_stmt_bind_param($statement, "ssss",
                    $email_address, $user, $pass, $verficationCode);

                $email_address = $_POST['email_address'];
                $user = $_POST['username'];
                $pass = md5($_POST['password']);                
                $verficationCode = md5(uniqid());       
				
				mysqli_stmt_execute($statement);
                echo 'query successful';
                exit();
                
            }

            else {
                echo "Unable to prepare query:". $sql_insertAdmin . " " .mysqli_error($conn). "<br />";
                exit();
            }
