
<?php include("header.php"); ?> 
  
<?php 
    include("connCheck.php");
    if (isset($_GET['status']) && $_GET['status'] == 'disabled'){
      
     ?>  
     
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Your Company Admin Account has not been verified</h3>
                    <p>Your request is being processed. Check your email for a verification link or contact us at superphishalteam@gmail.com for more details</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  
     <?php }     ?>

     <?php
if (isset($_GET['status']) && $_GET['status'] == 'registered'){
?>  

<div class="alert alert-success alert-dismissible fade show my-3" role="alert"> <!--green (success) alert box-->
               <h3>Your Company Admin Account registration is under review.</h3>
                <p>Upon verification an email will be sent by the Superphishal team to the provided email address.</p>
                <p> Alternatively, you may contact us at superphishalteam@gmail.com for further clarification</p>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>  
<?php }?>
<div class="container-fluid">
    <div class="col-sm-4 my-4">
        <div class="card">
            <div class="card-header mx-6">
                                Login Existing Company Admin Account

            </div>
                <div class="card-body">
                    <div class="form-group required">
                        <label>Email*</label>   
                        <input type="text" id="Email" class="form-control rounded" placeholder="Email" > 
                    </div>

                    <div class="form-group required">
                        <label>Password*</label>   
                        <input type="password" id="Password" class="form-control rounded" placeholder="Password" > 
                                    
                    </div>

                    <div class="form-group py-2">
                        <button type="button" id="BtnLogin" class="btn btn-primary btn-block">Login</button>
                                    
                    </div>
                </div>
            </div>        
    </div>

</div>
        <?php 
        include("footer.php"); 
        ?> 

            
            <script language="javascript">
		
        $("#BtnLogin").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var email = $("#Email").val();
                var password = $("#Password").val();

                if (email == null || email == "") {
                    alert(alertNotice);
                    $("#Email").focus();
                }
                
                else if (password == null || password == "") {
                    alert(alertNotice);
                    $("#Password").focus();
                }

                else {
                    
                    $.post("process.cadminLogin.php", {
                        email: email,
                        password: password
                    }, function(data,status) {                      
                    
						if(status == "success"){    
                            alert("Logged in successfully");                      
						
                        window.location = "cadminDashboard.php";
                        
                        
						} 
                    })
                }
            });


    </script>