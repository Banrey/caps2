  
<?php 
$sql_cadmin = "SELECT username, email
    FROM tblusers
    WHERE status = 'disabled' AND companyID =".$_SESSION['companyID'].";"
                            
                            ?>    
                                        
        <?php $qry_cadmin = mysqli_query($conn, $sql_cadmin);
        if(mysqli_num_rows($qry_cadmin) == 0){
            
            ?>
            <div class="col-md-12 card my-3 mx-auto">
            <div class="card-body"><?php  echo "No Registration requests";?></div></div>
            <?php 
         }
         else{
        ?>
        
		<?php while($get_cadmin = mysqli_fetch_array($qry_cadmin)){ ?>
            <div class="col-md-9 card my-3 mx-auto">
                <div class="card-body">
                    
            <?php echo $get_cadmin["username"]; ?> 
            <?php echo $get_cadmin["email"]; ?> 
            <a href=<?php echo "verifyCompanyAccount.php?email=".$get_cadmin["email"]."&action=accept"?>>Verify User  </a>
            <a href=<?php echo "verifyCompanyAccount.php?email=".$get_cadmin["email"]."&action=delete"?>>Delete</a>

                </div>

            </div>
            
            
            <?php } }?>