<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

session_start();

$sql_insert = "INSERT INTO comments
            ( postID,
            accID,
            message)
            VALUES (?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "iis",
                    $postID, $accID, $message);

                $postID = $_POST['postID'];
                if(empty($_SESSION['accID'])){
                    $accID = 2;
                }else{                    
                $accID = $_SESSION['accID'];
                }
                $message = $_POST['message'];
                echo $message.$accID.$postID;
				mysqli_stmt_execute($statement);
            }

            else {
                echo "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                exit();
            }