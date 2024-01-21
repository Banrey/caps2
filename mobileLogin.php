
<?php 
    include("header.php");       
    include_once("connCheck.php");

if (isset($_GET['status']) && $_GET['status'] == 'disabled'){
     ?>  
     
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Your Account has not been verified</h3>
                    <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  
     <?php }?>

     <?php
if (isset($_GET['login']) && $_GET['login'] == 'failed'){
     ?>  
     
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Wrong Login Code</h3>
                    <p>Please try again</p>
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
                                Login Using Mobile App

            </div>
                <div class="card-body">
                    <form action="process.mobileLogin.php" id="login_form" method="post"> 
                        
                    Please use the app to get your login code   

                <div class="form-group my-3" >
                                 <label class="required">Login Code *</label> 
                                 <div class="col-auto">
                                <input type="number" id="LoginCode" name="loginCode" class="form-control rounded my-2" placeholder="Login Code" required>
                                 </div>  
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
    </div>


</div>

            
    <script language="javascript">
		

    </script>

<!-- navbar ends here -->

   



<?php 
    include("footer.php");
     ?>