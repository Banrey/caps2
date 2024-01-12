
<?php
if (isset($_GET['status']) && $_GET['status'] == 'registered'){
?>  

<div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
               <h3>Your Account is not verified</h3>
                <p>Please wait for your Company Admin to verify your account</p>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>  
<?php }?>
<?php
if (isset($_GET['status']) && $_GET['status'] == 'new'){
?>  

<div class="alert alert-success alert-dismissible fade show my-3" role="alert"> <!--green (success) alert box-->
               <h3>Your Account has been registered</h3>
                <p>Please wait for your Company Admin to verify your account</p>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>  
<?php }?>

<?php
if (isset($_GET['status']) && $_GET['status'] == 'nologin'){
      
    ?>  
    
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                   <h3>This email is already registered to an account</h3>
                   <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>  
    <?php }?>

<div class="container-fluid">
    <div class="col-sm-4 my-4">
        <div class="card">
            <div class="card-header mx-6">
                                Login Company Account

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

                    <div class="form-group my-3 mx-2">
                        <button type="button" id="BtnCLogin" class="btn btn-primary btn-block">Login</button>
                        <span class="float-end">Don't have an account? <a href="companyAccReg.php">Click here to Register</a>   </span>
                                    
                    </div>
                </div>
            </div>   
            <div class="alert alert-primary my-3"> <!--blue (primary) alert box-->
                    <h3>Want to Register your company for Superphishal?</h3>
                    <a href="companyRegistration.php" class="link-danger link-underline-opacity-25">Register the Company here</a>
            </div>     
            <div class="alert alert-danger my-3"> <!--red (danger) alert box-->
                    <h3>Company already Registered?</h3>
                    <a href="cAdminLogin.php" class="link-primary link-underline-opacity-25">Manage your Registered Company here</a>
            </div>        
    </div>

</div>

            
            <script language="javascript">
		
        $("#BtnCLogin").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var email = $("#Email").val();
                var password = $("#Password").val();

                if (Email == null || Email == "") {
                    alert(alertNotice);
                    $("#Email").focus();
                }
                
                else if (password == null || password == "") {
                    alert(alertNotice);
                    $("#Password").focus();
                }

                else {
                    
                    $.post("process.companyAccLogin.php", {
                        email: email,
                        password: password
                    }, function(data,status) {                      
                    
						if(status == "success"){                          
							
                        window.location = "companyDash.php";
                        
                        
						} else{
                        window.location = "companyPortal.php?status="+ status;}
                    })
                }
            });


    </script>