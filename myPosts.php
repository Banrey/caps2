<?php 
include("connCheck.php");

include("header.php");

session_start();
include("requireLogin.php");
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<!-- navbar Starts here -->
<?php if(!empty($_SESSION["companyID"])){
                
                include("navbarCompany.php");
        
                }
                else{
                        include("navbarLogged.php");
        
                }
        
        ?>

            <!---->

                
<div class="container-fluid py-2">
                    <label for="recipient">Your Posts</label>
                   
                    
                    <div class="container-fluid col-lg-10 mx-2">
                            <?php
                                include("postloop.php");
                                include("cpostloop.php");
                            ?>         
                    </div>
                </div>

                <?php 
        include("navbarfoot.php");        
        ?>
                <?php 
include("footer.php");
?>
