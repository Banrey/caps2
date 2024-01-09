<?php
session_start();
if ($_SESSION['status'] < 1 || empty($_SESSION['session_id'])) {
    header("location: index.php");
    exit();
}
?>