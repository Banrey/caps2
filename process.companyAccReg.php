<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "SELECT count(accID) AS ctr FROM tblusers WHERE email LIKE ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "s", $email_address);
	
	$email_address = $_POST['email_address'];
    
    str_replace("@","_",$email_address);
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr);
	while(mysqli_stmt_fetch($statement_check)){
		if($ctr > 0){
            echo "Email already registered";
            header("location: companyAccReg.php?status=registered");
			exit();
		}
	}
	
}

$sql_insert = "INSERT INTO tblusers
            (email,
            username,
            password,
            accType,
            companyID
            )
            VALUES (?, ?, ?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "ssssi",
                    $email_address, $username, $password, $accType, $companyID);

                $email_address = $_POST['email_address'];
                $username = $_POST['username'];
                $password = md5($_POST['password']);
                $accType = "company";
                $companyID = $_POST['companyID'];

        
				
				mysqli_stmt_execute($statement);
                exit();

            }

            else {
                echo "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                exit();
            }