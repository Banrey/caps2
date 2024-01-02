<?php
//
// filename: connect.php

class connect{
    function connect(){
        $conn = new PDO("mysql:host=localhost; dbname=superphishal","root","");

        return $conn;
    }
}


$hostname = "localhost";
$username = "root";
$password = "";
$database = "superphishal";

$conn = mysqli_connect($hostname, $username, $password, $database);
if (!$conn) {
    echo "Unable to connect to database<strong>" . $database . "</strong><br />";
    echo mysqli_connect_error();
}
