  
<?php 
$sql_cadmin = "SELECT username, email
    FROM tblusers
    WHERE status = 'enabled' AND companyID =".$_SESSION['companyID'].";"
                            
                            ?>    
                                        
        <?php $qry_cadmin = mysqli_query($conn, $sql_cadmin);
        if(mysqli_num_rows($qry_cadmin) == 0){
            
            ?>
            <div class="col-md-12 card my-3 mx-auto">
            <div class="card-body"><?php  echo "No Registered Users";?></div></div>
            <?php 
         }
         else{
        ?>
        
		<?php while($get_cadmin = mysqli_fetch_array($qry_cadmin)){ ?>
            <div class="col-md-9 card my-3 mx-auto">
                <div class="card-body">
                    
            <?php echo $get_cadmin["username"]; ?> 
            <?php echo $get_cadmin["email"]; ?> 
            <button class="btn btn-danger btnv my-3" id=<?php echo $get_cadmin["email"]?> name="delete">Delete User Account</button>

                </div>

            </div>
            
            
            <?php } }?>

            
            <script>
                
           
const buttons = document.querySelectorAll(".btnv");

// loop through each button and add a click event listener
buttons.forEach(function(button) {
  button.addEventListener("click", function() {
    event.preventDefault();      
    
    var action = this.name;
    var email = this.id;
    alert(action);
    
    $.post("verifyCompanyAccount.php", {
        action: action,
        email: email

        }, function(data,status) {
            if(status == "success"){
            window.location = "cadminDashboard.php"
            }
        })

});
});
            </script>