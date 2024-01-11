<?php

session_start();
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_insert = "INSERT INTO companyposts
            (accID,
            title,
            content,
            companyID
            )
            VALUES (?, ?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "issi",
                    $accID, $title, $content, $companyID);

                $accID = $_SESSION['accID'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $companyID = $_SESSION['companyID'];

        
				
				mysqli_stmt_execute($statement);
            }

            else {
                echo "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                exit();
            }