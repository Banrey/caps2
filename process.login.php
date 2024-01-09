<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_check = "SELECT COUNT(accID) AS ctr, 
    accID, email, username, accType, dateCreated, status
FROM 
    tblusers 
WHERE   
    email = ? AND password = ?" ;
    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "ss", $email, $password);
        
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        mysqli_stmt_execute($statement_check);
        
        mysqli_stmt_bind_result($statement_check, $ctr, $accID, $email, $username, $accType, $accDate, $status);
        while(mysqli_stmt_fetch($statement_check)){
            if($ctr == 1){
                if ($status == 'disabled') {
                    
            header("location: index.php?status=".$status);
                }
                else{
                session_start();
                $_SESSION['session_id'] = session_id();
                $_SESSION['accID'] = $accID;
                $_SESSION['email_address'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['accType'] = $accType;
                $_SESSION['dateCreated'] = $accDate;   
                $_SESSION['status'] = $status;
                
            header("location: personalDash.php");
        }
                
               
            }  else{
                header("location: index.php?login=failed");
            }
        }
    }
