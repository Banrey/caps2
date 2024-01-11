<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "SELECT count(accID) AS ctr FROM tblusers WHERE email = ?";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "s", $email_address);
	
	$email_address =  $_REQUEST["email"];
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr);
	while(mysqli_stmt_fetch($statement_check)){
		if($ctr > 0){
            $response["message"] =  "Email already registered";
            $response["success"] =  0;
			die(json_encode($response));
		} else{
            $response["message2"] =  "Email not registered";
			
            json_encode($response);
        }

	}
	
}

$sql_insert = "INSERT INTO tblusers
            (email,
            username,
            password
            )
            VALUES (?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "sss",
                    $email_address, $username, $password);

                $email_address = $_REQUEST["email"];
                $username = $_REQUEST["username"];
                $password = md5($_REQUEST["password"]);
				mysqli_stmt_execute($statement);
                //execute sql statement
                $response["success"] = 1;
                $response["message"] = "Registered Successfully";
                die(json_encode($response));
                //encode data into json

        
				
            }

            else {
                $response["message"] = "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                $response["success"] = 0;
                die(json_encode($response));
            }