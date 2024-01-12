<?php
if (isset($_GET['status']) && $_GET['status'] == 'disabled'){
     ?>  
     
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Your Account has not been verified</h3>
                    <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  
     <?php }?>

<?php
if (isset($_GET['status']) && $_GET['status'] == 'verified'){
?>  

<div class="alert alert-success alert-dismissible fade show my-3" role="alert"> <!--green (success) alert box-->
               <h3>Your Account has been verified</h3>
               <p>You may now log in to your account</p>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>  
<?php }?>

<?php
if (isset($_GET['status']) && $_GET['status'] == 'registered'){
?>  

<div class="alert alert-success alert-dismissible fade show my-3" role="alert"> <!--green (success) alert box-->
               <h3>Your Account has been Registered</h3>
                <p>Please verify your account by following the instructions sent to your email</p>
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>  
<?php }?>
<div class="container-fluid">
    <div class="col-sm-4 my-4">
        <div class="card">
            <div class="card-header mx-6">
                                Login Existing Account

            </div>
                <div class="card-body">
                    <form action="process.login.php" id="login_form" method="post">                    
                <div class="form-group" >
                                 <label class="required">Email *</label>   
                                <input type="email" id="Email" name="email" class="form-control rounded" placeholder="E-mail" required> 
                </div>

                <div class="form-group ">
                                <label class="required">Password *</label>   
                                <input type="password" id="Password" name="password" class="form-control rounded" placeholder="Password" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required> 
                                
                </div>

                    <div class="form-group py-2 mx-2">
                                <input type="submit" id="BtnLogin" name="login" class="btn btn-primary" value="Login">
                                
                            </div>
                       <span class="float-end">Don't have an account? <a href="registration.php">Click here to Register</a> </span>  
                       <span class="float-end">In a hurry? <a href="guestDash.php">Login as Guest Here</a> </span>   
                    </div>
                    </form>                    
                </div>
                
            </div>  
            <div class="alert alert-primary my-3"> <!--blue (primary) alert box-->
                    <h3>Want to use Superphishal for work?</h3>
                    <a href="companyPortal.php" class="link-danger">->Enter the Company Portal here<-</a>
            </div>     
              
            <div class="alert alert-primary my-3"> <!--blue (primary) alert box-->
                    <h3>Want to try our app?</h3>
                    <a href="appLogin.php" class="link-danger">->Enter the Company Portal here<-</a>
            </div>      
    </div>


</div>

            
    <script language="javascript">
		

    </script>