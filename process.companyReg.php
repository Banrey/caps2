<?php
session_start();
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");


$sql_insertCompany = "INSERT INTO tblcompanynames
            (companyName,
            companyDesc,
            cadminID
            )
            VALUES (?, ?, ?)";

            if ($statement = mysqli_prepare($conn, $sql_insertCompany)) {
                mysqli_stmt_bind_param($statement, "ssi",
                    $companyName, $companyDesc, $cadminID);

                $companyName = $_POST['companyName'];
                $companyDesc = $_POST['companyDesc'];
                $cadminID = $_SESSION['cadminID'];
        
				
				mysqli_stmt_execute($statement);
                echo "query successful";
            }

            else {
                echo "Unable to prepare query:". $sql_insertCompany . " " .mysqli_error($conn). "<br />";
                exit();
            }



        
