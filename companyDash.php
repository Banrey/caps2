<?php
session_start();

include("requireLogin.php");


include("connCheck.php");

if($_SESSION['status'] == 'enabled'){

header("location: companyForum.php");

} else{
    
header("location: companyPortal.php?status=registered");
}

?>
</body>
</html>
