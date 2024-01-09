<?php
if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");



if (@$_GET["action"] == "approve"){
	$sql_delete = "UPDATE transactions SET status = 1 WHERE ID = ?";
	if ($approve_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($approve_check, "i", $id);
		$id = $_GET["transaction_ID"];
		mysqli_stmt_execute($approve_check);
		header("location: approved.transactions.php");
		exit();
	}
}

    
