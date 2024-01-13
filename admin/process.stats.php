<?php
if (!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

if (@$_GET["action"] == "delete"){
	$sql_delete = "DELETE FROM stats WHERE statID = ?";
	if ($delete_check = mysqli_prepare($conn, $sql_delete)){
		mysqli_stmt_bind_param($delete_check, "i", $id);
		$id = $_GET["statID"];
		mysqli_stmt_execute($delete_check);
		header("location: stats.php");
		exit();
	}
}else{
	
	$filename = $_FILES["uploadfile"]["name"];
	$filename = str_replace(' ', '_', $filename);
    $tempname = $_FILES["uploadfile"]["tmp_name"];	
	$tempname = str_replace(' ', '_', $tempname);
    $folder = ".././images/" . $filename;

	if (empty($_POST["statID"])){

			if (isset($_FILES["uploadfile"]["name"])) {	
				$sql_check = "INSERT INTO stats (title, content, image) VALUES (?, ?, ?)";
				if ($statement_check = mysqli_prepare($conn, $sql_check)){
					mysqli_stmt_bind_param($statement_check, "sss", $title, $content, $image);
					
		
		
					// Now let's move the uploaded image into the folder: images
					if (move_uploaded_file($tempname, $folder)) {
						echo "<h3>  Image uploaded successfully!</h3>";
					} else {
						echo "<h3>  Failed to upload image!</h3>";
					}
					
					$title = $_POST['title'];
					$content = $_POST['content']; 
					$image = $filename; 
					mysqli_stmt_execute($statement_check);
					echo "<h3>  Stats uploaded!</h3>";
				
				}
		} else{	
			
			$filename = "placeholder.svg";
			$tempname = "placeholder.svg";
			$folder = ".././images/" . $filename;

			$sql_check = "INSERT INTO stats (title, content, image) VALUES (?, ?, ?)";
			if ($statement_check = mysqli_prepare($conn, $sql_check)){
				mysqli_stmt_bind_param($statement_check, "sss", $title, $content, $image);
	
				
				
				$title = $_POST['title'];
				$content = $_POST['content']; 
				$image = $filename; 
				mysqli_stmt_execute($statement_check);
				
				echo "<h3>  Stats uploaded!</h3>";
				echo "<h3>  no image detacted</h3>";
			

		}
	}
	}
	else{
		if (isset($_FILES["uploadfile"]["name"])) {			


			$sql_check = "UPDATE stats SET title = ?, content = ?, image = ? WHERE statID = ? ";
			if ($statement_check = mysqli_prepare($conn, $sql_check)){
				mysqli_stmt_bind_param($statement_check, "sssi", $title, $content, $image, $id);
				
			if (move_uploaded_file($tempname, $folder)) {
				echo "<h3>  Image uploaded successfully!</h3>";
			} else {
				echo "<h3>  Failed to upload image!</h3>";
			}
				
				$title = $_POST['title'];
				$content = $_POST['content'];
				$image = $filename; 
				$id = $_POST['statID'];
				mysqli_stmt_execute($statement_check);
				echo "<h3>  Stats updated!</h3>";
				echo "<h3>  Image updated!</h3>";
			
			}
		} else{
			$sql_check = "UPDATE stats SET title = ?, content = ? WHERE statID = ? ";
			if ($statement_check = mysqli_prepare($conn, $sql_check)){
				mysqli_stmt_bind_param($statement_check, "ssi", $title, $content, $id);			
				
				$title = $_POST['title'];
				$content = $_POST['content'];
				$image = $filename; 
				$id = $_POST['statID'];
				mysqli_stmt_execute($statement_check);
				echo "<h3>  Stats updated!</h3>";

		}
	}
	}

}

header("location: stats.php");

