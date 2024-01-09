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
    email = ? AND password = ?";
    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "ss", $email, $pword);
        
        $email = $_POST['email'];
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
                
                echo  $ctr. $cID. $email. $user; 
               
            }  else{
                $_SESSION['session_id'] = "";
                $_SESSION['status'] = 0;
                //error handling
                echo  $ctr. $cID. $email. $user."fail"; 
            }
        }
    }