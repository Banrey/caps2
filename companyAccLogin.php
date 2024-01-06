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
                        <span class="float-end">Don't have an account? <a href="registration.php">Click here to Register</a>   </span>
                                    
                    </div>
                </div>
            </div>   
            <div class="alert alert-primary my-3"> <!--blue (primary) alert box-->
                    <h3>Want to Register your company for Superphishal?</h3>
                    <a href="companyPortal.php" class="link-danger link-underline-opacity-25">Register the Company here</a>
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
                        
                        
						} else{alert("Wrong Credentials");}
                    })
                }
            });


    </script>