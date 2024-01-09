
<?php
session_start(); 
include("connCheck.php");

if (empty($_SESSION['status'])||$_SESSION['status'] == 'disabled') {
       
    header("location: cAdminLogin.php?status=disabled");
    exit(); 
 }
if(empty(session_id())){
    include("navbarHead.php");
} else{include("navbarLogged.php");}
?>

<div class="container">
    
</div>
<div class="col-sm-4 my-4">
                <div class="card mx-auto">
                        <div class="card-header mx-6">
                            Manage your company 

                        </div>
                        <?php include("manageCompanyLoop.php");?>
                </div>        
        </div>

<?php

include("companyRegistration.php");



?>

<?php

include("navbarfoot.php");
?>
