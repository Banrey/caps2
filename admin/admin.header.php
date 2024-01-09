<?php
session_start();
if ($_SESSION['status'] < 1 || empty($_SESSION['session_id'])) {
    header("location: index.php");
    exit();
}

?>

<html>
<head>
<title>SuperPhisal</title>
<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../styles/styles.css" />
<script language="javascript" src="../bootstrap/js/bootstrap.js"></script>
<script language="javascript" src="../js/jquery.js"></script>
</head>
<body>
<div class="container my-1 border">
    <div class="row">
        <div class="col-sm-12 "><?php include("navigation.php") ?></div>
    </div>
</div>
