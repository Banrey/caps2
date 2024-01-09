


<?php 

    include("header.php");
    
    ?>   
<?php 

    include("forum.php");
    if ($_SESSION['status']=='disabled') {
        
        ?>
        <script>window.location = "index.php?status=disabled";</script>
        <?php
    }
    
    include("requireLogin.php");
     ?>
       

<!-- navbar ends here -->

   



<?php 
    include("footer.php");
     ?>


