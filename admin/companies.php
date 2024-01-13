<?php

include("admin.header.php");
if(!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

$txt_id = "";
$txt_username = "";
$txt_email = "";
$txt_vcode = "";
$txt_status = "";

if (@$_GET["action"] == "update"){
	$sql_cat = "SELECT  cadminID, username, email, verificationCode, status FROM tblcompanyadmin WHERE cadminID = ?";

    if ($cat_check = mysqli_prepare($conn, $sql_cat)){
        mysqli_stmt_bind_param($cat_check, "i", $id,);
        
        $id = $_GET['cadminID'];

        mysqli_stmt_execute($cat_check);
        
        mysqli_stmt_bind_result($cat_check, $ID, $username, $email, $verificationCode, $status);
        while(mysqli_stmt_fetch($cat_check)){
			
           $txt_id = $ID;
		   $txt_username = $username;
		   $txt_email = $email;
		   $txt_vcode = $verificationCode;
		   $txt_status = $status;
		   
            
        }
    }

}
?>




<div class="container border">
    <div class="row overflow-auto p-2" style="max-height: 500px;">
        <div class="col-sm-12 ">
			<div class="row">
				<h3>Company Admin Accounts</h3>
				<div class="col-sm-5 ">
					<div class="form-group">
										<label>Admin ID</label>   
										<input value="<?php echo $txt_id; ?>" type="text" id="cadminID" class="form-control rounded" placeholder="Title" disabled> 
									
					</div>
            	</div>

				<div class="col-sm-5 ">
					<div class="form-group">
											<label>Username</label>   
											<input value="<?php echo $txt_username; ?>" type="text" id="username" class="form-control rounded" placeholder="Content"  disabled> 
										
					</div>
				</div>	

				<div class="col-sm-5 ">
					<div class="form-group">
											<label>E-mail</label>   
											<input value="<?php echo $txt_email; ?>" type="text" id="email" class="form-control rounded" placeholder="Content" disabled > 
										
					</div>
				</div>	
				
				<div class="col-sm-5 ">
					<div class="form-group">
											<label>Verification Code</label>   
											<input value="<?php echo $txt_vcode; ?>" type="text" id="verificationCode" class="form-control rounded" placeholder="Verification Code" disabled > 
										 </select>
										
					</div>
				</div>	

				<div class="col-sm-5 ">
					<div class="form-group">
											<label>Status</label>   
											<input value="<?php echo $txt_status; ?>" type="text" id="verificationCode" class="form-control rounded" placeholder="Verification Code" disabled >
										 </select>
										
					</div>
				</div>	
				
				<div class="col-sm-2 float-end">
					<div class="form-group">
						<input type="hidden" value="<?php echo $txt_id; ?>" id="id" >
						<button type="button" id="BtnPost" class="btn btn-warning btn-block my-3">Verify</button>
										
					</div>
            	</div>
			</div>
        </div>
    </div>
        <div class="row p-2">
            <div class="col-sm-12 ">
				<table border="1" class="table table-striped">
					<thead>
						<tr> 
							<td width= "10%">Action</td>
							<td width= "10%">Admin ID</td>
							<td width= "20%">Username</td>
							<td width= "20%">E-mail</td>
							<td width= "25%">Verification Code</td>							
							<td width= "15%">Status</td>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0; ?>
						<?php $sql_post = "
						SELECT 
							cadminID, username, email, verificationCode, status
						FROM tblcompanyadmin
							" ?>
						<?php $qry_post = mysqli_query($conn, $sql_post); ?>
						<?php while($get_post = mysqli_fetch_array($qry_post)){ ?>
						<?php $ctr++; ?>
						<tr class="overflow-auto">
							<td> <a href="companies.php?action=update&cadminID=<?php echo $get_post["cadminID"] ?>"> 
							Select</a> /
							<a href="process.companies.php?action=delete&cadminID=<?php echo $get_post["cadminID"] ?>">
							Reject</a>
							</td>
							<td><?php echo $get_post["cadminID"] ?></td>
							<td><?php echo $get_post["username"] ?></td>
							<td><?php echo $get_post["email"] ?></td>
							<td><?php echo $get_post["verificationCode"] ?></td>
							<td><?php echo $get_post["status"] ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = "3">Total Accounts :<?php echo $ctr; ?></td>
						</tr>
					</tfoot>
				</table>
            </div>            
        </div>
</div>



<script language="javascript">
        $("#BtnPost").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

				var txt_cadminID = $("#cadminID").val();
                var txt_username = $("#username").val();
                var txt_email = $("#email").val();
                var txt_verificationCode = $("#verificationCode").val();
                var txt_status = "enabled";
				

                if (txt_cadminID == null || txt_cadminID == "") {
                    alert(alertNotice);
                    $("#cadminID").focus();
                }
                

                else {
                    
                    $.post("process.companies.php", {
                        cadminID: txt_cadminID,
                        status: txt_status,
                        email: txt_email,
                        verificationCode: txt_verificationCode
                    }, function(data,status) {
                        
						if(status == "success"){
                        window.location = "companies.php";
						}
                    })
                }
            });


    </script>

<?php
include("admin.footer.php");
