<?php
require("connect.php");
$emailCV = $_REQUEST["email"];
str_replace("@","_",$emailCV);
$passwordCV = $_REQUEST["password"];
$sql = "SELECT accID, email, username, accType, dateCreated FROM tblusers WHERE password = ".$passwordCV." AND email LIKE ".$emailCV;
$select_sql = "SELECT accID, email, username, accType, dateCreated FROM tblusers";
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
            $stmt->bind_result($accID, $email, $username, $accType, $dateCreated);                                                         
            

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