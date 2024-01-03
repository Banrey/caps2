<?php
require("connect.php");

$sql_check = "SELECT COUNT(accID) AS ctr, 
    accID, email, username, accType, dateCreated
FROM 
    tblusers
WHERE   
    email = ? AND password = ?";

$sql_check = str_replace("\\", "", $sql_check);
if ($statement_check = mysqli_prepare($conn, $sql_check)){
    mysqli_stmt_bind_param($statement_check, "ss", $email, $password);
    
    $email = ""$_REQUEST["email"]"";
    $password = $_REQUEST["password"];
    mysqli_stmt_execute($statement_check);
    
    mysqli_stmt_bind_result($statement_check, $ctr, $accID, $email, $username, $accType, $accDate);
    while(mysqli_stmt_fetch($statement_check)){
        if($ctr == 1){
            
            $response = array();
            $response["accID"] = $accID;
            $response["email"] = $email;
            $response["username"] = $username;
            $response["password"] = $password;
            $response["accType"] = $accType;
            $response["dateCreated"] = $dateCreated;
            die(json_encode($response));

        }  else{
            $response["message"] = "User does not exist";
            $response["success"] = 0;
            die(json_encode($response));
            
        }
    }
}


/*


    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "ss", $email, $password);
        
        $email = $_REQUEST["email"];
        $password = $_REQUEST["password"]);
        mysqli_stmt_execute($statement_check);
        
        mysqli_stmt_bind_result($statement_check, $ctr, $accID, $email, $username, $accType, $accDate);
        while(mysqli_stmt_fetch($statement_check)){
            if($ctr == 1){
                
                $response = array();
                $response["accID"] = $accID;
                $response["email"] = $email;
                $response["username"] = $username;
                $response["password"] = $password;
                $response["accType"] = $accType;
                $response["dateCreated"] = $dateCreated;
                die(json_encode($response));

            }  else{
                $response["message"] = "User does not exist";
                $response["success"] = 0;
                die(json_encode($response));
                
            }
        }
    }

 */
?>