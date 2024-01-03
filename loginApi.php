<?php
require("connect.php");
$sql = "SELECT * FROM tblusers WHERE ". $_REQUEST["code"] ;

$select_sql = "SELECT * FROM tblusers";
$sql = str_replace("\\", "", $sql);
$select_sql = str_replace("\\", "", $select_sql);
try {
    $dbrecords = mysqli_query($conn, $select_sql);
    if (mysqli_num_rows($dbrecords) > 0) {
        if (mysqli_query($conn, $sql)) {
            $response["success"] = 1;
            //$response["message"] = "DATA ->". $sql; 
            $response["message"] = "DATA EXISTS";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $stmt->bind_result($accID, $email, $username, $password,$accType,$dateCreated);                                                         
            

            while($stmt->fetch()){
                $response["accID"] = $accID;
                $response["email"] = $email;
                $response["username"] = $username;
                $response["accType"] = $accType;
                $response["dateCreated"] = $dateCreated;
            }

            die(json_encode($response));
        } else {
            $response["success"] = 0;
            $response["message"] = "Account not found in Database. Please Try again!" . $sql;
            die(json_encode($response));
        }
    }
} catch (Exception $e) {
    $response["success"] = 0;
    $response["message"] = "Account does not exist in Database. Please Try again!";
    die(json_encode($response));
}
$response["success"] = 1;
$response["message"] = " DATA -> " . $select_sql;
$response["message"] = " Record Saved. ";
die(json_encode($response));
?>