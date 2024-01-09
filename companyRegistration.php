<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-center"></div>
    </div>

    

        <div class="row">
            <div class="col-sm-12 text-end">
                <?php include("header.php"); ?> 
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-8">
            

            </div>

            <div class="col-sm-6 my-4">
                <div class="card">
                        <div class="card-header mx-6">
                            Register an admin account for your company 

                        </div>
                        <div class="card-body">                    
                            
                        <form  action = "process.registration.php" id="register_form" method="post" target="empty">                           
                                <div class="form-group" >
                                 <label class="required">Admin User Name</label>   
                                <input type="text" id="regusername" name="username" class="form-control rounded" data-parsley-pattern="/^[a-zA-Z\s]+$/" required placeholder="User Name" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">Admin E-mail Address</label>   
                                <input type="email" id="regEmailAddress" name="email_address" class="form-control rounded" placeholder="E-mail" required> 
                            </div>

                            <div class="form-group ">
                                <label class="required">Admin Password</label>   
                                <input type="password" id="regPassword" name="password" class="form-control rounded" placeholder="Password" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required> 
                                
                            </div>

                            <div class="form-group ">
                                <label class="required">Confirm Password</label>   
                                <input type="password" id="regConPassword" name="confirmPassword" class="form-control rounded" placeholder="Confirm Password" data-parsley-equalto="#regPassword" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required> 
                                
                            </div>

                            <div class="form-group py-2">
                                <input type="submit" name="register" id="BtnReg" class="btn btn-success" value="Register">
                                <span class="float-end mx-3 my-2">Already have an admin account? <a href="cAdminLogin.php">Click here to Login</a> </span>  
                            </div>
                            
                        
                            </form>
                        </div>
                </div>        



            </div>
        </div>

    </div>
</div>

    <script language="javascript">
        
        $(document).ready(function(){

$('#register_form').parsley();

    $('#register_form').parsley().on('form:submit', function() {

        var email = $("#regEmailAddress").val();
        var password = $("#regPassword").val();
        var username = $("#regusername").val();

        let html_data = `
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Processing Request</h3>
                    <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  `;
        
        $('#cont').append(html_data);
                    
        $.post("process.adminReg.php", {
                        email_address: email,
                        password: password,
                        username: username
                    }, function(data,status) {
						if(status == "success"){
                        alert("You have successfully registered");
						window.location = "cAdminLogin.php?p=Login_first_time";
						}
                    })
  });
});


    </script>

    
<?php include("footer.php");?>