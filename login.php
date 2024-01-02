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
                        <button type="button" id="BtnLogin" class="btn btn-primary btn-block">Login</button>
                        Don't have an account? <a href="registration.php">Click here to Register</a>   
                    </div>

                    
                </div>
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
							
                        window.location = "dashboard.php";
                        
                        
						} 
                    })
                }
            });


    </script>