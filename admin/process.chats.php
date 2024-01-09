<?php
if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete"){
	$sql_delete = "DELETE FROM tblchats WHERE chatID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["chatID"];
		mysqli_stmt_execute($delete_check);
		header("location: dashboard.php");
		exit();
	}
}else{
	if (empty($_POST["chatID"])){
		$sql_check = "INSERT INTO tblchats (sendID, receiveID, message) VALUES (?, ?, ?)";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "iis", $sendID, $receiveID, $message);
			
			$sendID = $_POST['sendID'];
			$receiveID = $_POST['receiveID']; 
			$message = $_POST['message']; 
			mysqli_stmt_execute($statement_check);
        
		}
	}
	else{
		$sql_check = "UPDATE tblchats SET sendID = ?, receiveID = ?, message = ? WHERE chatID =? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "iisi", $sendID, $receiveID, $message, $chatID);
			
			$sendID = $_POST['sendID'];
			$receiveID = $_POST['receiveID']; 
			$message = $_POST['message']; 
			$chatID = $_POST['chatID']; 
			mysqli_stmt_execute($statement_check);
        
		}
	}

}