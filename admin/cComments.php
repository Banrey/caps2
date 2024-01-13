<?php

include("admin.header.php");
if(!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

$txt_commentID = "";
$txt_postID = "";
$txt_accID = "";
$txt_message = "";
if (@$_GET["action"] == "update"){
	$sql_cat = "SELECT commentID, postID, accID, message FROM companycomments WHERE commentID = ?";

    if ($cat_check = mysqli_prepare($conn, $sql_cat)){
        mysqli_stmt_bind_param($cat_check, "i", $commentID,);
        
        $commentID = $_GET['commentID'];

        mysqli_stmt_execute($cat_check);
        
        mysqli_stmt_bind_result($cat_check, $commentID, $postID, $accID, $message);
        while(mysqli_stmt_fetch($cat_check)){
			
           $txt_commentID = $commentID;
		   $txt_postID = $postID;
		   $txt_accID = $accID;
		   $txt_message = $message;
            
        }
    }

}
?>




<div class="container border">
    <div class="row overflow-auto p-2" style="max-height: 500px;">
        <div class="col-sm-12 ">
			<div class="row">
				<h3>Comments</h3>
				<div class="col-sm-3 ">
					<div class="form-group">
										<label>Post ID</label>   
										<input value="<?php echo $txt_postID; ?>" type="text" id="postID" class="form-control rounded" placeholder="Post ID" > 
									
					</div>
            	</div>

				<div class="col-sm-3 ">
					<div class="form-group">
											<label>Account ID</label>   
											<input value="<?php echo $txt_accID; ?>" type="text" id="accID" class="form-control rounded" placeholder="Account ID" > 
										
					</div>
				</div>	

				<div class="col-sm-4 ">
					<div class="form-group">
											<label>Message</label>   
											<input value="<?php echo $txt_message; ?>" type="text" id="message" class="form-control rounded" placeholder="Message" > 
										
					</div>
				</div>	
				
				<div class="col-auto me-auto">
					<div class="form-group">
						<input type="hidden" value="<?php echo $txt_commentID; ?>" id="id" >
						<button type="button" id="BtnComment" class="btn btn-warning btn-block float-end">Save Comment</button>
										
					</div>
            	</div>
			</div>
        </div>
    </div>
        <div class="row p-2">
            <div class="col-sm-12">
				<table border="1" class="table table-striped ">
					<thead style =" position: sticky;">
						<tr> 
							<td width= "15%">Action</td>
							<td width= "12%">Comment ID</td>
							<td width= "12%">Post ID</td>
							<td width= "20%">Account ID</td>
							<td width= "20%">Message</td>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0; ?>
						<?php $sql_comment = "
						SELECT 
							*
						FROM companycomments
							" ?>
						<?php $qry_comment = mysqli_query($conn, $sql_comment); ?>
						<?php while($get_comment = mysqli_fetch_array($qry_comment)){ ?>
						<?php $ctr++; ?>
						<tr>
							<td> <a href="cComments.php?action=update&commentID=<?php echo $get_comment["commentID"] ?>"> 
							Update</a> /
							<a href="process.cComments.php?action=delete&commentID=<?php echo $get_comment["commentID"] ?>">
							Delete</a>
							</td>
							<td><?php echo $get_comment["commentID"] ?></td>
							<td><?php echo $get_comment["postID"] ?></td>
							<td><?php if ($get_comment["accID"] == "") { echo "guest";
								# code...
							 }else{echo $get_comment["accID"];} ?></td>
							<td><?php echo $get_comment["message"] ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = "3">Total Comments :<?php echo $ctr; ?></td>
						</tr>
					</tfoot>
				</table>
            </div>
</div>






<script language="javascript">
        $("#BtnComment").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var postID = $("#postID").val();
                var accID = $("#accID").val();
                var message = $("#message").val();
                var commentID = $("#id").val();
				

                if (postID == null || postID == "") {
                    alert(alertNotice);
                    $("#postID").focus();
                }
                
                else if (accID == null || accID == "") {
                    alert(alertNotice);
                    $("#message").focus();
                }
                
                else if (message == null || message == "") {
                    alert(alertNotice);
                    $("#message").focus();
                }
                
                

                else {
                    
                    $.post("process.cComments.php", {
                        postID: postID,
                        accID: accID,
                        message: message,
                        commentID: commentID
                    }, function(data,status) {
                        
						if(status == "success"){
							console.log(data);
                        window.location = "cComments.php";
						}
                    })
                }
            });


    </script>

<?php
include("admin.footer.php");
