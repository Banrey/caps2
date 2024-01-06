<?php
session_start();
include("connCheck.php");

?>

            
        <?php if(empty($_SESSION["accID"])){
    include("navbarHead.php");
} else{
        if(!empty($_SESSION["companyID"])){
                
        include("navbarCompany.php");

        }
        else{
                include("navbarLogged.php");

        }
}

include("forumContent.php");
include("navbarfoot.php");
        ?>


<!-- navbar ends here -->
    
