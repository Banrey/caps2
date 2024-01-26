<?php
if (!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

if (@$_GET["action"] == "rate"){
	$sql_rate = "UPDATE companycomments SET rating = ? WHERE commentID = ?";
	if ($rate_check = mysqli_prepare($conn, $sql_rate)){
		mysqli_stmt_bind_param($rate_check, "ii", $rating, $id);
		$id = $_POST["commentID"];
        $rating = $_POST["rating"];
		mysqli_stmt_execute($rate_check);
        echo "rated successfuly";
		exit();
	}
}else{
	
		$sql_check = "UPDATE companyposts SET title = ?, content = ?, status = ? WHERE postID =? ";
		if ($statement_check = mysqli_prepare($conn, $sql_check)){
			mysqli_stmt_bind_param($statement_check, "sssi", $title, $content, $status, $id);
			
			$title = $_POST['title'];
			$content = $_POST['content'];
			$id = $_POST['postID'];
			$status = $_POST['status'];
			mysqli_stmt_execute($statement_check);
			
		exit();
        
		}
}