<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

session_start();

$sql_insert = "INSERT INTO companycomments
            ( postID,
            accID, 
            companyID,
            message)
            VALUES (?, ?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "iiis",
                    $postID, $accID, $companyID, $message);

                $postID = $_POST['postID'];                      
                $accID = $_SESSION['accID'];
                $companyID = $_SESSION['companyID'];
                $message = $_POST['message'];
                echo $message.$accID.$postID;
				mysqli_stmt_execute($statement);
            }

            else {
                echo "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                exit();
            }