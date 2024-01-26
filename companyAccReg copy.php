<?php 
    
    if (isset($_GET['account']) && $_GET['account'] == 'registered'){
      
        ?>  
        
        <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                       <h3>This email is already registered to an account</h3>
                       <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>  
        <?php }?>

        <?php
            
if (isset($_GET['account']) && $_GET['account'] == 'nologin'){
      
    ?>  
    
    <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                   <h3>This email is already registered to an account</h3>
                   <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>  
    <?php }?>
     
<div class="container-fluid" id="cont">
    <div class="row">
        <div class="col-sm-12 text-center"></div>
    </div>

    

        <div class="row">
            <div class="col-sm-12 text-end">
                <?php// include("main_navigation.php"); ?> 
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-sm-8">
            

            </div>
            <iframe name="empty" style="display:none;"></iframe>

            <div class="col-sm-6 my-4">
                <div class="card">
                        <div class="card-header mx-6">
                            Register New Account

                        </div>
                        <div class="card-body">
                            <form  action = "process.registration.php" id="register_form" method="post" target="empty">                           
                                <div class="form-group" >
                                 <label class="required">First Name</label>   
                                <input type="text" id="regfirstname" name="username" class="form-control rounded" data-parsley-pattern="/^[a-zA-Z\s]+$/" required placeholder="First Name" > 
                            </div>
                                                      
                                <div class="form-group" >
                                 <label class="required">Last Name</label>   
                                <input type="text" id="reglastname" name="username" class="form-control rounded" data-parsley-pattern="/^[a-zA-Z\s]+$/" required placeholder="Last Name" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">E-mail Address</label>   
                                <input type="email" id="regEmailAddress" name="email_address" class="form-control rounded" placeholder="E-mail" required> 
                            </div>

                            <div class="form-group ">
                                <label class="required">Password</label>   
                                <input type="password" id="regPassword" name="password" class="form-control rounded" placeholder="Password" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z0-9\s]+$/" required> 
                                
                            </div>

                            <div class="form-group ">
                                <label class="required">Confirm Password</label>   
                                <input type="password" id="regConPassword" name="password" class="form-control rounded" placeholder="Confirm Password" data-parsley-equalto="#regPassword" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required> 
                                
                            </div>

                                                        
                            <div class="form-group">
                                <label class="my-3">Company *</label>   
                                <select name="companies" id="companies" placeholder="Pick your company">
                                    <?php include("companyloop.php");?>
                                </select>
                            </div>

                            <div class="form-group py-2">
                                <input type="submit" name="register" id="BtnReg" class="btn btn-success" value="Register">
                                <span class="float-end mx-3 my-2">Already have an account? <a href="index.php">Click here to Login</a> </span>  
                                <span class="float-end mx-3 my-2">In a hurry? <a href="guestDash.php">Login as Guest Here</a> </span>  
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
                var firstname = $("#regfirstname").val();                
                var lastname = $("#reglastname").val();
                var username = firstname.concat(" ",lastname);
                var companyID = $("#companies").val();

                

                    
                    $.post("process.companyAccReg.php", {
                        email_address: email,
                        password: password,
                        username: username,
                        companyID: companyID
                    }, function(data,status) {
						if(status == "success"){                       
                window.location = "companyPortal.php?status=new";
						}
                    })
  });




});


    </script>

    
<?php include("footer.php");?>