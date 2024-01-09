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
                            
                            <div class="form-group">
                                 <label class="required">Administrator E-mail Address *</label>   
                                <input type="text" id="regEmailAddress" class="form-control rounded" placeholder="E-mail" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">Administrator Username *</label>   
                                <input type="text" id="regUsername" class="form-control rounded" placeholder="Username" > 
                            </div>

                            <div class="form-group ">
                                <label class="required">Administrator Password *</label>   
                                <input type="password" id="regPassword" class="form-control rounded" placeholder="Password" > 
                                
                            </div>

                            <div class="form-group py-2">
                                <button type="button" id="BtnReg" class="btn btn-primary btn-block">Reg</button>
                                
                            </div>
                        </div>
                </div>        



            </div>
        </div>

    </div>
</div>

    <script language="javascript">
        $("#BtnReg").on("click", function() {
                var alertNotice = "Fields marked with * are required.";

                var email = $("#regEmailAddress").val();
                var password = $("#regPassword").val();
                var username = $("#regUsername").val();

                if (email == null || email == "") {
                    alert(alertNotice);
                    $("#EmailAddress").focus();
                }
                
                else if (password == null || password == "") {
                    alert(alertNotice);
                    $("#Password").focus();
                }
                
                else if (username == null || username == "") {
                    alert(alertNotice);
                    $("#username").focus();
                }
            
                
                

                else {
                    
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
                }
            });


    </script>

    
<?php include("footer.php");?>