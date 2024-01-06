<div class="container-fluid">
    <div class="col-sm-4 my-4">
        <div class="card">
            <div class="card-header mx-6">
                                Login Existing Account

            </div>
                <div class="card-body">
                    <div class="form-group required">
                        <label>Username*</label>   
                        <input type="text" id="Username" class="form-control rounded" placeholder="Username" > 
                    </div>

                    <div class="form-group required">
                        <label>Password*</label>   
                        <input type="password" id="Password" class="form-control rounded" placeholder="Password" > 
                                    
                    </div>

                    <div class="form-group py-2 mx-2">
                        <button type="button" id="BtnLogin" class="btn btn-primary btn-block py-auto">Login</button>
                       <span class="float-end">Don't have an account? <a href="registration.php">Click here to Register</a> </span>  
                       <span class="float-end">In a hurry? <a href="guestDash.php">Login as Guest Here</a> </span>   
                    </div>

                    
                </div>
                
            </div>  
            <div class="alert alert-primary my-3"> <!--blue (primary) alert box-->
                    <h3>Want to use Superphishal for work?</h3>
                    <a href="companyPortal.php" class="link-danger">->Enter the Company Portal here<-</a>
            </div>      
    </div>


</div>

            
            <script language="javascript">
		
        $("#BtnLogin").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var username = $("#Username").val();
                var password = $("#Password").val();

                if (username == null || username == "") {
                    alert(alertNotice);
                    $("#Username").focus();
                }
                
                else if (password == null || password == "") {
                    alert(alertNotice);
                    $("#Password").focus();
                }

                else {
                    
                    $.post("process.login.php", {
                        username: username,
                        password: password
                    }, function(data,status) {                      
                    
						if(status == "success"){                          
							
                        window.location = "personalDash.php";
                        
                        
						} 
                    })
                }
            });


    </script>