  
<?php 
$sql_cadmin = "SELECT companyID, companyName
    FROM
    tblcompanynames
    WHERE cadminID =".$_SESSION['cadminID'].";"
                            
                            ?>    
                                        
        <?php $qry_cadmin = mysqli_query($conn, $sql_cadmin);
        if(mysqli_num_rows($qry_cadmin) == 0){
            
            ?>
            <div class="col-md-12 card my-3 mx-auto">
            <div class="card-body"><a href="createCompany.php"><?php  echo "Create a company";?></a></div></div>
            <?php 
         }
         else{
        ?>
        
		<?php while($get_cadmin = mysqli_fetch_array($qry_cadmin)){ ?>
            <div class="col-md-9 card my-3 mx-auto">
                <div class="card-body">
                    
            <?php echo $get_cadmin["companyName"]; $_SESSION['companyID'] = $get_cadmin["companyID"];?> 
            <a href=<?php echo "companyDetails.php?companyID=".$get_cadmin["companyID"]."&action=accept"?>>Details  </a>
            <a href=<?php echo "process.companyDetails.php?companyID=".$get_cadmin["companyID"]."&action=delete"?>>Delete</a>

                </div>

            </div>
            
            

        
<div class="col-sm-4 my-4">
                <div class="card mx-auto">
                        <div class="card-header mx-6">
                            Registration Requests 

                        </div>
                        <?php include("companyReqLoop.php");?>
                </div>        
        </div>

<div class="col-sm-4 my-4">
                <div class="card mx-auto">
                        <div class="card-header mx-6">
                            Registered Users 

                        </div>
                        <?php include("companyRegLoop.php");?>
                </div>        
        </div>
    
</div>
            <?php }
                    
        }?>

            