<?php

if (!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "UPDATE posts SET status = ? WHERE postID = ? ";
if (@$_GET["action"] == "solved"){
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "si", $status, $requestID);
			
			$status = 'solved';
			$requestID = $_GET['postID'];
			mysqli_stmt_execute($statement_check);
        
		}
        
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
    else{
        if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "si", $status, $requestID);
        
        $status = 'unsolved';
        $requestID = $_GET['postID'];
        mysqli_stmt_execute($statement_check);
    
    }

    header('Location: ' . $_SERVER['HTTP_REFERER']);

    }

    ?>