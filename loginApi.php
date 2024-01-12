


    
<?php
include("connCheck.php");
    


$sql_check = "SELECT COUNT(accID) AS ctr, 
    accID, email, username, accType, dateCreated, status
FROM 
    tblusers 
WHERE   
    password = ? AND email LIKE ?" ;
    
    
    if ($statement_check = mysqli_prepare($conn, $sql_check)){
        mysqli_stmt_bind_param($statement_check, "ss", $password, $email);
        
        $email = $_REQUEST['email'];
        str_replace("@","_",$email);
        $password = md5($_REQUEST['password']);
        mysqli_stmt_execute($statement_check);
        
        mysqli_stmt_bind_result($statement_check, $ctr, $accID, $email, $username, $accType, $accDate, $status);
        while(mysqli_stmt_fetch($statement_check)){
            if($ctr == 1){
                if ($status == 'disabled') {
                    
                $response["success"] = 0;
                $response["status"] = $status;
                $response["message"] = "Your account is ".$status;
                
                die(json_encode($response));

                }
                else{

                    
                $response["success"] = 1;
                $response["accID"] = $accID;
                $response["email"] = $email;
                $response["username"] = $username;
                $response["accType"] = $accType;
                $response["dateCreated"] = $accDate;   
                $response["status"] = $status;
                $response["message"] = $status;
                die(json_encode($response));
                
        }
                
               
            }  else{                
                $response["success"] = 0;
                $response["message"] = "Wrong Credentials";
                die(json_encode($response));


            }
        }
    }?>
