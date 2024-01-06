<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");
session_start();

$sql_insert = "INSERT INTO tblchats
            (sendID,
            receiveID,
            message
            )
            VALUES (?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insert)) {
                mysqli_stmt_bind_param($statement, "iis",
                    $sendID, $receiveID, $message);

                $sendID = $_SESSION['accID'];
                $receiveID = $_POST['receiveID'];
                $message = $_POST['message'];

        
				
				mysqli_stmt_execute($statement);
            }

            else {
                echo "Unable to prepare query:". $sql_insert . " " .mysqli_error($conn). "<br />";
                exit();
            }