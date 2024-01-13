<?php
if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete"){
	$sql_delete = "DELETE FROM companycomments WHERE commentID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["commentID"];
		mysqli_stmt_execute($delete_check);
		header("location: cComments.php");
		exit();
	}
} else{
	if (empty($_POST["commentID"])){
		$sql_check = "INSERT INTO companycomments (postID, accID, message) VALUES (?, ?, ?)";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "iis", $postID, $accID, $message);
			
			$postID = $_POST['postID']; 
			$accID = $_POST['accID']; 
			$message = $_POST['message']; 

			mysqli_stmt_execute($statement_check);
        
		}
	}
	else{
		$sql_check = "UPDATE companycomments SET postID = ?, accID = ?, message = ? WHERE commentID = ?  ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "iisi", $postID, $accID, $message, $commentID);
			
			$postID = $_POST['postID'];             
            $accID = $_POST['accID']; 
            if($accID == 0 or $accID == "" or $accID == NULL){$accID = NULL;}
            else {            
                $accID = $accID;               
            }
			$message = $_POST['message'];             
			$commentID = $_POST['commentID']; 
			mysqli_stmt_execute($statement_check);
        
		}
	}

}