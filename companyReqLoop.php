  
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

            <button class="btn btn-primary btnv mx-3" id=<?php echo $get_cadmin["email"]?>>Verify User  </button>
            <button class="btn btn-danger btnv" id=<?php echo $get_cadmin["email"]?> name="delete">Delete</button>

                </div>

            </div>
            
            
            <?php } }?>

            