<?php 
session_start();
include("header.php");
include("navbarCompany.php");
include("connCheck.php");

?>
<?php $sql_company = "
                            SELECT companyName, companyDesc
                            FROM tblcompanynames 
                            WHERE companyID = ".$_GET["companyID"]							
                            ?>  
                            <?php
                            
         $qry_company = mysqli_query($conn, $sql_company); 
         while($get_company = mysqli_fetch_array($qry_company)) { ?>
<div class="col-md-8 my-4">
                <div class="card">
                        <div class="card-header mx-6">
                            Edit company details 

                        </div>
                        <div class="card-body">                    
                            
                            <div class="form-group">
                                 <label class="required">Company Name *</label>   
                                <input type="text" id="regCName" class="form-control rounded" placeholder="Company Name" value=<?php echo $get_company["companyName"]?>> 
                            </div>
                            
                            <div class="form-group">
                                 <label class="required">Company Description *</label>   
                                 <textarea id="regCDesc" class="my-2 form-control rounded" rows="8" placeholder="Enter a description for your company" value=><?php echo $get_company["companyDesc"]?></textarea>
                            </div>

                            <div class="form-group py-2">
                                <button type="button" id="BtnEdit" class="btn btn-primary btn-block float-end">Save Changes</button>
                                
                            </div>
                        </div>
                </div>        

            <?php } ?>

            </div>

            <?php
            include("navbarfoot.php");
            ?>

<script language="javascript">
		
        $("#BtnEdit").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var companyName = $("#regCName").val();
                var companyDesc = $("#regCDesc").val();
                var companyID = <?php echo $_GET["companyID"]?>;

                if (companyName == null || companyName == "") {
                    alert(alertNotice);
                    $("#regCName").focus();
                }
                
                else if (companyDesc == null || companyDesc == "") {
                    alert(alertNotice);
                    $("#regCDesc").focus();
                }

                else {
                    
                    $.post("process.editCompany.php", {
                        companyName: companyName,
                        companyDesc: companyDesc,
                        companyID: companyID
                    }, function(data,status) {
						if(status == "success"){
                        window.location = "editCompany.php?companyID=" + companyID;
                        alert("Changes Saved");
						}
                    })
                }
            });


            



    </script>