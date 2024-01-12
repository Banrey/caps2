<?php
include("connCheck.php");
$sql_check = "UPDATE tblcompanynames SET companyName = ?, companyDesc = ? WHERE companyID = ? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "ssi", $companyName, $companyDesc, $companyID);
			
			$companyName = $_POST["companyName"];
			$companyDesc = $_POST["companyDesc"];
			$companyID = $_POST["companyID"];
			mysqli_stmt_execute($statement_check);
            echo "query sucessful";
        
		} else{
            echo "query failed";
        }