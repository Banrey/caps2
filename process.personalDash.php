<?php

		$sql_check = "UPDATE tblusers SET loginCode = ? WHERE email LIKE ? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "is", $loginCode, $email);
			
			$loginCode = NULL;
			$email = $_SESSION['email_address'];			
			str_replace("@","_",$email);
			mysqli_stmt_execute($statement_check);
            
			
        
		} else{   
            echo "email does not exist";   

        
		}
        ?>
	