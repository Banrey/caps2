<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");


if (@$_GET["action"] == "guestlogin"){
    session_start();
    $_SESSION['session_id'] = session_id();
    $_SESSION['accID'] = "";
    $_SESSION['email_address'] = "guest";
    $_SESSION['username'] = "guest";
    $_SESSION['accType'] =  "personal";
    $_SESSION['dateCreated'] = "guest";                
    $_SESSION['status'] = 1;

}

$sql_check = "SELECT COUNT(accID) AS ctr, 
    accID, email, username, accType, dateCreated
FROM 
    tblusers 
WHERE   
    username = ? AND password = ?";
    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "ss", $username, $password);
        
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        mysqli_stmt_execute($statement_check);
        
        mysqli_stmt_bind_result($statement_check, $ctr, $accID, $email, $username, $accType, $accDate);
        while(mysqli_stmt_fetch($statement_check)){
            if($ctr == 1){
                session_start();
                $_SESSION['session_id'] = session_id();
                $_SESSION['accID'] = $accID;
                $_SESSION['email_address'] = $email;
                $_SESSION['username'] = $username;
                $_SESSION['accType'] = $accType;
                $_SESSION['dateCreated'] = $accDate;                
                $_SESSION['status'] = 1;
                
                echo  $ctr. $accID. $email. $accDate; 
               
            }  else{
                $_SESSION['session_id'] = "";
                $_SESSION['status'] = 0;
            }
        }
    }
