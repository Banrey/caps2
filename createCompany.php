
<?php include("header.php"); ?> 



    

        

            <div class="col-md-8 my-4">
                <div class="card">
                        <div class="card-header mx-6">
                            Register a company 

                        </div>
                        <div class="card-body">                    
                            
                            <div class="form-group">
                                 <label class="required">Company Name *</label>   
                                <input type="text" id="regCName" class="form-control rounded" placeholder="Company Name" > 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">Company Description *</label>   
                                 <textarea id="regCDesc" class="my-2 form-control rounded" rows="8" placeholder="Enter a description for your company"></textarea>
                            </div>

                            <div class="form-group py-2">
                                <button type="button" id="BtnReg" class="btn btn-primary btn-block">Register</button>
                                
                            </div>
                        </div>
                </div>        



            </div>

            
    <script language="javascript">
        $("#BtnReg").on("click", function() {
                var alertNotice = "Fields marked with * are required.";

                var companyDesc = $("#regCDesc").val();
                var companyName = $("#regCName").val();
           
                
                if (companyDesc == null || companyDesc == "") {
                    alert(alertNotice);
                    $("#regCDesc").focus();
                }
                
                else if (companyName == null || companyName == "") {
                    alert(alertNotice);
                    $("#regCName").focus();
                }
            
                
                

                else {
                    
                    $.post("process.companyReg.php", {
                        companyDesc: companyDesc,
                        companyName: companyName
                    }, function(data,status) {
						if(status == "success"){
                        alert("You have successfully registered");
						window.location = "cadminDashboard.php";
						}
                    })
                }
            });


    </script>

    
<?php include("footer.php");?>