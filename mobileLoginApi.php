<?php

if (!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

		$sql_check = "UPDATE tblusers SET loginCode = ? WHERE password = ? AND email LIKE ? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "iss", $loginCode, $password, $email);
			
			$loginCode = mt_rand(1000,9999);
			$password = $_POST['password'];
			$email = $_POST['email'];			
			str_replace("@","_",$email);
			mysqli_stmt_execute($statement_check);
			
			$response["success"] = 1;
			$response["message"] = $loginCode;
			$response["loginCode"] = $loginCode;
			die(json_encode($response));
        
		} else{                
			$response["success"] = 0;
			$response["message"] = "Wrong Credentials";
			die(json_encode($response));
		}
	