

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
	<link rel="stylesheet" href="login/css/register.css">

    
	<!-- Load Scripts -->
<script language="javascript" src="bootstrap/js/bootstrap.js"></script>
<script language="javascript" src="js/jquery.js"></script>
<script src="js/parsley.min.js"></script>
</head>

<body>
	<div class="container-fluid" id="cont">
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
		<div class="card card-login">
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-lg-6 col-md-12">
						<div class="padding bg-success text-center align-items-center d-flex" >
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
						
							<h2>Register Company Account</h2>
							<p class="lead">Before you get started, you must login or register if you don't already have an account.</p>
							<form autocomplete="off" id="register_form" method="post">
							
								<div class="form-group">
									<label class="d-block" for="regusername">
										Admin User Name
										
									</label>
									<input type="text" id="regusername" class="form-control rounded" data-parsley-pattern="/^[a-zA-Z\s]+$/" required placeholder="User Name" tabindex = "2" > 
								</div>
								<div class="form-group">
								
									<label for="Email">Admin E-mail</label>
									<input type="email" id="regEmailAddress" name="email_address" class="form-control rounded" placeholder="E-mail" required tabindex = "3">  
                                </div>
								<div class="form-group">
									<label class="d-block" for="password">
										Password
										
									</label>
									<input type="password" id="regPassword" name="password" class="form-control rounded" placeholder="Password" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required  tabindex = "4">
								</div>
								<div class="form-group">
									<label class="d-block" for="regConPassword">
										Confirm Password
										
									</label>  
                                <input type="password" id="regConPassword" name="password" class="form-control rounded" placeholder="Confirm Password" data-parsley-equalto="#regPassword" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required tabindex = "5"> 
								</div>
								<div class="form-group text-right">
									<div class="float-left ">
										<a href="cAdminLogin.php">Already have an account? Login here</a>
									</div>
									<input type="submit" class="btn btn-success my-2" tabindex="6" value="Register">
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
</body>

    <script language="javascript">
        $(document).ready(function(){

$('#register_form').parsley();

    $('#register_form').parsley().on('form:submit', function() {

var email = $("#regEmailAddress").val();
var password = $("#regPassword").val();
var username = $("#regusername").val();


            
$.post("process.adminReg.php", {
                email_address: email,
                password: password,
                username: username
            }, function(data,status) {
                if(status == "success"){
                    
                window.location = "cAdminLogin.php?status=registered";
                }
            })
});




});


    </script>

    
<?php include("footer.php");?>