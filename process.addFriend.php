<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

session_start();

$sql_check = "SELECT count(requestID) AS ctr, status FROM tblfriendrequest WHERE (senderID = ? and receiveID = ? OR senderID = ? and receiveID = ?) AND status = 'Pending' OR 'Accepted'";
if ($statement_check = mysqli_prepare($conn, $sql_check)){
	mysqli_stmt_bind_param($statement_check, "iiii", $senderID, $receiveID, $receiveID, $senderID);
	
	$senderID = $_SESSION['accID'];
	$receiveID = $_POST['friendID'];
	mysqli_stmt_execute($statement_check);
	
	mysqli_stmt_bind_result($statement_check, $ctr,$status);
	while(mysqli_stmt_fetch($statement_check)){
		if($ctr > 0){
            echo "Friend Request already Sent";
			exit();
		}
	}
	
}

$sql_insert = "INSERT INTO tblfriendrequest
            (senderID,
            receiveID
            )
            VALUES (?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "ii", $senderID, $receiveID);

                $senderID = $_SESSION['accID'];
                $receiveID = $_POST['friendID'];        
				
				mysqli_stmt_execute($statement);
                echo "Friend Request Sent successfully";
            }

            else {
                echo "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                exit();
            }