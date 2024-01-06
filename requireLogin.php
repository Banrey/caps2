<?php
if (empty($_SESSION['session_id'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
}
?>