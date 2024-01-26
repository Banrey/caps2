<?php
if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");


$sql_check = "SELECT 
COUNT(cadminID) AS ctr, 
cadminID, username, status
FROM 
    tblcompanyadmin
WHERE   
    password = ? AND email LIKE ?";
    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "ss", $pword, $email);
        
        $email = $_POST['email'];
        str_replace("@","_",$email);
        $pword = md5($_POST['password']);
        mysqli_stmt_execute($statement_check);
        
        mysqli_stmt_bind_result($statement_check, $ctr, $cID, $user, $status);
        while(mysqli_stmt_fetch($statement_check)){
            if($ctr == 1){
                session_start();
                $_SESSION['session_id'] = session_id();
                $_SESSION['cadminID'] = $cID;
                $_SESSION['email_address'] = $_POST['email'];
                $_SESSION['username'] = $user;             
                $_SESSION['status'] = $status;
                
                exit();
               
            }  else{
                $_SESSION['session_id'] = "";
                $_SESSION['status'] = "nologin";
                //error handling
                echo  $ctr. $cID. $email. $user."fail"; 
                exit();
            }
        }
    }