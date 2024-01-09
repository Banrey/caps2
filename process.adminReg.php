<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_checkEmail = "SELECT count(cadminID) AS ctr FROM tblcompanyadmin WHERE email = ?";
if ($statement_check = mysqli_prepare($conn, $sql_checkEmail)){
	mysqli_stmt_bind_param($statement_check, "s", $email_address);
	
	$email_address = $_POST['email_address'];
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr);
	while(mysqli_stmt_fetch($statement_check)){
		if($ctr > 0){
            echo "Email already registered";
			exit();
		}
	}
	
}


$sql_insertAdmin = "INSERT INTO tblcompanyadmin
            (email,
            username,
            password
            )
            VALUES (?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insertAdmin)) {
                mysqli_stmt_bind_param($statement, "sss",
                    $email_address, $user, $pass);

                $email_address = $_POST['email_address'];
                $user = $_POST['username'];
                $pass = md5($_POST['password']);

        
				
				mysqli_stmt_execute($statement);
            }

            else {
                echo "Unable to prepare query:". $sql_insertAdmin . " " .mysqli_error($conn). "<br />";
                exit();
            }
