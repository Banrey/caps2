<?php 
    include_once("connCheck.php");
   
     ?>
<!DOCTYPE html>
<html>
<head>
	<!-- Karakter encoding -->
	<meta charset="utf-8">
	<!-- 
		Perintah agar lebar viewport mengikuti lebar perangkat
		dan skala mengikuti ukuran ketika web di-load
	 -->
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Superphishal</title>
    
	<!-- Load bootstrap stylesheet -->
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
	<!-- Load login stylesheet -->
	<link rel="stylesheet" href="login/css/login.css">

    
	<!-- Load Scripts -->
<script language="javascript" src="bootstrap/js/bootstrap.js"></script>
<script language="javascript" src="js/jquery.js"></script>
<script src="js/parsley.min.js"></script>
</head>

<body>
	<div class="container-fluid">
        <!-- warnings-->
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
if (isset($_GET['login']) && $_GET['login'] == 'failed'){
     ?>  
     
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Wrong Credentials</h3>
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
<!-- warnings-->
		<div class="card card-login">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-12">
						<div class="padding bg-warning text-center align-items-center d-flex" >
							<div id="particles-js"></div>
							<div class="w-100">
								<div class="logo mb-4">
									<img src="login/img/kodinger.jpg" alt="kodinger logo" class="img-fluid">
								</div>
								<h2 class="text-light mb-2">WELCOME TO SUPERPHISHAL</h2>
								<p class="lead" style="color:white">Share your experience, knowledge, and solutions in phishing for the awareness of others.</p>
								
							</div>

							
						</div>
					</div>
					<div class="col-lg-6 col-md-12">
						<div class="padding">
						
							<h2>Login</h2>
							<p class="lead">Before you get started, you must login or register if you don't already have an account.</p>
							<form autocomplete="off" action="process.login.php" id="login_form" method="post">
							
								<div class="form-group">
								
									<label for="Email">E-mail</label>
                        <input type="email" id="Email" name="email" class="form-control rounded" placeholder="E-mail" required tabindex="1">
								</div>
								<div class="form-group">
									<label class="d-block" for="password">
										Password
										
									</label>
									<input type="password" id="Password" name="password" class="form-control rounded" placeholder="Password" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required tabindex="2">
								</div>
								<div class="form-group text-right">
									<div class="float-left">
										<a href="guestDash.php">Login as Guest here</a>
									</div><br>
									<div class="float-left ">
										<a href="registration.php">Create an account?</a>
									</div>
									<button class="btn btn-warning my-2" tabindex="3">
										Login
									</button>
                                    <a href="mobileLogin.php">
									<button class="btn btn-warning my-2" type="button" tabindex="3">
										Login using app
									</button></a><br>
									<div class="float-left">
										<a href="companyPortal.php">Login using a company account.</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>

</html>