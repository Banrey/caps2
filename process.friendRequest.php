<?php

if (!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "UPDATE tblfriendrequest SET status = ? WHERE requestID = ? ";
if (@$_GET["action"] == "accept"){
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "si", $status, $requestID);
			
			$status = 'Accepted';
			$requestID = $_GET['requestID'];
			mysqli_stmt_execute($statement_check);
        
		}
    }
    else{
        if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "si", $status, $requestID);
        
        $status = 'Rejected';
        $requestID = $_GET['requestID'];
        mysqli_stmt_execute($statement_check);
    
    }

    }

    ?>