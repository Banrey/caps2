<?php
if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete"){
	$sql_delete = "DELETE FROM companyposts WHERE postID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["postID"];
		mysqli_stmt_execute($delete_check);
		header("location: cPosts.php");
		exit();
	}
}else{
	if (empty($_POST["postID"])){
		$sql_check = "INSERT INTO companyposts (title, content) VALUES (?, ?)";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "ss", $title, $content);
			
			$title = $_POST['title'];
			$content = $_POST['content']; 
			mysqli_stmt_execute($statement_check);
        
		}
	}
	else{
		$sql_check = "UPDATE companyposts SET title = ?, content = ? WHERE postID =? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "ssi", $title, $content, $id);
			
			$title = $_POST['title'];
			$content = $_POST['content'];
			$id = $_POST['postID'];
			mysqli_stmt_execute($statement_check);
        
		}
	}

}