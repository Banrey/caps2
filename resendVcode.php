<?php
if (isset($_GET['status']) && $_GET['status'] == 'disabled'){
     ?>  
     
     <div class="alert alert-danger alert-dismissible fade show my-3" role="alert"> <!--red (danger) alert box-->
                    <h3>Your Account has not been verified</h3>
                    <p>Check your email for a verification link or contact us at superphishalteam@gmail.com</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>  
     <?php }
     include('header.php')
     ?>
<div class="container-fluid">
    <div class="col-sm-4 my-4">
        <div class="card">
            <div class="card-header mx-6">
                                Resend Verification Code

            </div>
                <div class="card-body">
                    <form action="process.resendVcode.php" id="login_form" method="post">                    
                <div class="form-group" >
                                 <label class="required">Email *</label>   
                                <input type="email" id="Email" name="email" class="form-control rounded" placeholder="E-mail" required> 
                </div>

                    <div class="form-group py-2 mx-2">
                                <input type="submit" id="BtnLogin" name="login" class="btn btn-primary" value="Resend Code">
                                
                            </div>
                    </div>
                    </form>                    
                </div>
                
            </div>      
    </div>


</div>

            
    <script language="javascript">
		

    </script>