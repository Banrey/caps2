<?php
if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete"){
	$sql_delete = "DELETE FROM stats WHERE postID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["postID"];
		mysqli_stmt_execute($delete_check);
		header("location: dashboard.php");
		exit();
	}
}else{
	if (empty($_POST["postID"])){
		$sql_check = "INSERT INTO stats (title, content, image) VALUES (?, ?, ?)";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "sss", $title, $content, $image);
			
			$title = $_POST['title'];
			$content = $_POST['content']; 
			$image = $_POST['image']; 
			mysqli_stmt_execute($statement_check);
        
		}
	}
	else{
		$sql_check = "UPDATE posts SET title = ?, content = ?, image ? WHERE postID =? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "ssis", $title, $content, $image, $id);
			
			$title = $_POST['title'];
			$content = $_POST['content'];
			$image = $_POST['image']; 
			$id = $_POST['statID'];
			mysqli_stmt_execute($statement_check);
        
		}
	}

}