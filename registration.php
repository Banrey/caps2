<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$error = '';
$success_message = '';

if(isset($_POST["registration"])){
    session_start();
    if (isset($_SESSION['user_data'])) {
        header('location:chatroom.php');
    }

    require_once('ChatUser.php');
    $user_object = new ChatUser;
    $user_object->setUserName($_POST['user_name']);
    $user_object->setUserEmail($_POST['user_email']);
    $user_object->setUserPass($_POST['user_password']);
    $user_object->setUserProfile($user_object->make_avatar(strtoupper($_POST['user_name'][0])));
    $user_object->setUserStatus('Disabled');
    $user_object->setUserCreatedOn(date('Y-m-d H:i:s'));
    $user_object->setUserVerificationCode(md5(uniqid()));
    $user_data = $user_object->get_user_data_by_email();

    if (is_array($user_data) && count($user_data) > 0) {
        $error = "Email already Registered";
    }
    else {
        if ($user_object->save_data()) {
            $success = 'Registration Completed';
        }
        else {
            $error= 'Something went wrong';
        }
    }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Superphishal</title>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="styles/styles.css" />
<script language="javascript" src="bootstrap/js/bootstrap.js"></script>
<script language="javascript" src="js/jquery.js"></script>
<script src="js/parsley.min.js"></script>
</head>
<body>
    
<script language="javascript" src="js/jquery.js"></script>
<script src="js/parsley.min.js"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 text-center"></div>
    </div>

    

        <div class="row">
            <div class="col-sm-12 text-end">
                <?php  if ($error != '') {
                    echo ' 
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    '.$error.'
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                     </div>
                     '; 
                }
                
            if ($success_message != '') {
                echo '
                <div class="alert alert-success">
                '.$success_message.'
                </div>
                ';
            }?> 
            </div>
        </div>

       

        <div class="row mt-3">
            <div class="col-sm-8">
            

            </div>

            <div class="col-sm-6 my-4">
                <div class="card">
                        <div class="card-header mx-6">
                            Register New Account

                        </div>
                        <div class="card-body">
                            
                        <form id="register_form" method="post">
                            <div class="form-group" >
                                 <label class="required">User Name *</label>   
                                <input type="text" id="user_name" name="user_name" class="form-control rounded" data-parsley-pattern="/^[a-zA-Z\s]+$/" required placeholder="User Name" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">E-mail Address *</label>   
                                <input type="text" id="user_email" name="user_email" class="form-control rounded" placeholder="E-mail" required> 
                            </div>

                            <div class="form-group ">
                                <label class="required">Password *</label>   
                                <input type="password" id="user_password" name="user_password" class="form-control rounded" placeholder="Password" data-parsley-minlength = "6" data-parsley-maxlength = "12" data-parsley-pattern="/^[a-zA-Z\s]+$/" required> 
                                
                            </div>

                            <div class="form-group py-2">
                                <input type="submit" name="register" class="btn btn-success" value="Register">
                                
                            </div>

                        </form>
                            
                            
                        </div>
                </div>        



            </div>
        </div>

    </div>
</div>
    
</body>

<script>
    $(document).ready(function () {
        
  $('#register_form').parsley();
    });
    </script>
</html>



    