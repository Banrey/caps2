<?php include('header.php');

include("connCheck.php"); ?>
<div class="container-fluid">
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

            <div class="col-sm-6 my-4">
                <div class="card">
                        <div class="card-header mx-6">
                            Register New Account

                        </div>
                        <div class="card-body">
                            
                        <div class="form-group">
                                 <label class="required">First Name *</label>   
                                <input type="text" id="regfirstname" class="form-control rounded" placeholder="First Name" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">Last Name *</label>   
                                <input type="text" id="reglastname" class="form-control rounded" placeholder="Last Name" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">E-mail Address *</label>   
                                <input type="text" id="regEmailAddress" class="form-control rounded" placeholder="E-mail" > 
                            </div>

                            <div class="form-group ">
                                <label class="required">Password *</label>   
                                <input type="password" id="regPassword" class="form-control rounded" placeholder="Password" > 
                                
                            </div>
                            <div class="form-group">
                                <label class="required">Company *</label>   
                                <select name="companies" id="companies" placeholder="Pick your company">
                                    <?php include("companyloop.php");?>
                                </select>
                                
                            </div>

                            <div class="form-group py-2">
                                <button type="button" id="BtnCReg" class="btn btn-primary btn-block">Register</button>
                                
                            </div>
                        </div>
                </div>        



            </div>
        </div>

    </div>
</div>

    <script language="javascript">
        $("#BtnCReg").on("click", function() {
                var alertNotice = "Fields marked with * are required.";

                var email = $("#regEmailAddress").val();
                var password = $("#regPassword").val();
                var firstname = $("#regfirstname").val();                
                var lastname = $("#reglastname").val();
                var username = firstname.concat(" ",lastname);
                var companyID = $("#companies").val();

                if (email == null || email == "") {
                    alert(alertNotice);
                    $("#regEmailAddress").focus();
                }
                
                else if (password == null || password == "") {
                    alert(alertNotice);
                    $("#Password").focus();
                }
                
                else if (firstname == null || firstname == "") {
                    alert(alertNotice);
                    $("#regfirstname").focus();
                }
                
                else if (lastname == null || lastname == "") {
                    alert(alertNotice);
                    $("#reglastname").focus();
                }
                else if (username == null || username == "") {
                    alert("username");
                    $("#reglastname").focus();
                }
                
                else if (companyID == null || companyID == "") {
                    alert("companies");
                    $("#companies").focus();
                }
            
                
                

                else {
                    
                    $.post("process.companyAccReg.php", {
                        email_address: email,
                        password: password,
                        username: username,
                        companyID: companyID
                    }, function(data,status) {
                        
						if(status == "success"){
                        alert("You have successfully registered");
						window.location = "companyDash.php";
						}
                    })
                }
            });


    </script>

    
<?php include("footer.php");?>