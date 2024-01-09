<?php

include("admin.header.php");
if(!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

?>




<div class="container border">
    <div class="row overflow-auto p-2" style="max-height: 500px;">
        <div class="col-sm-12 ">
			<div class="row">
				<h3>Posts</h3>
			</div>
        </div>
    </div>
        <div class="row p-2">
            <div class="col-sm-12 ">
				<table border="1" class="table table-striped">
					<thead>
						<tr> 
							<td width= "12%">Post ID</td>
							<td width= "12%">Account ID</td>
							<td width= "20%">Title</td>
							<td width= "35%">Content</td>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0; ?>
						<?php $sql_post = "
						SELECT 
							*
						FROM posts
							" ?>
						<?php $qry_post = mysqli_query($conn, $sql_post); ?>
						<?php while($get_post = mysqli_fetch_array($qry_post)){ ?>
						<?php $ctr++; ?>
						<tr class="overflow-auto">
							
							<td><?php echo $get_post["postID"] ?></td>
							<td><?php echo $get_post["accID"] ?></td>
							<td><?php echo $get_post["title"] ?></td>
							<td><?php echo $get_post["content"] ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = "3">Total Posts :<?php echo $ctr; ?></td>
						</tr>
					</tfoot>
				</table>
            </div>            
        </div>
</div>



<div class="container my-2 border">
<div class="row p-2">
        <div class="col-sm-12">
		
            <h3>Comments</h3>
        </div>
    </div>
    
        <div class="row overflow-auto p-2" style="max-height: 500px;">
            <div class="col-sm-12">
				<table border="1" class="table table-striped ">
					<thead style ="position: sticky;">
						<tr> 
							<td width= "12%">Comment ID</td>
							<td width= "12%">Post ID</td>
							<td width= "20%">Account ID</td>
							<td width= "35%">Message</td>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0; ?>
						<?php $sql_comment = "
						SELECT 
							*
						FROM comments
							" ?>
						<?php $qry_comment = mysqli_query($conn, $sql_comment); ?>
						<?php while($get_comment = mysqli_fetch_array($qry_comment)){ ?>
						<?php $ctr++; ?>
						<tr>
							<td><?php echo $get_comment["commentID"] ?></td>
							<td><?php echo $get_comment["postID"] ?></td>
							<td><?php if ($get_comment["accID"] == "") { echo "guest";
								# code...
							}echo $get_comment["accID"] ?></td>
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
</div>


<div class="container my-2 border">
    <div class="row ">
        <div class="col-sm-12 ">
		
            <h3>Chats</h3>
        </div>
    </div>
        <div class="row overflow-auto p-2" style="max-height: 500px;">
            <div class="col-sm-12 mh-50 overflow-auto">
				<table border="1" class="table table-striped">
					<thead style ="position: sticky;">
						<tr> 
							<td width= "12%">Chat ID</td>
							<td width= "12%">Sender ID</td>
							<td width= "20%">Receiver ID</td>
							<td width= "20%">Message</td>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0; ?>
						<?php $sql_chat = "
						SELECT 
							*
						FROM tblchats
							" ?>
						<?php $qry_chat = mysqli_query($conn, $sql_chat); ?>
						<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
						<?php $ctr++; ?>
						<tr>
							<td><?php echo $get_chat["chatID"] ?></td>
							<td><?php echo $get_chat["sendID"] ?></td>
							<td><?php echo $get_chat["receiveID"] ?></td>
							<td><?php echo $get_chat["message"] ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = "3">Total Chats :<?php echo $ctr; ?></td>
						</tr>
					</tfoot>
				</table>
            </div>            
        </div>
</div>


<script language="javascript">
        $("#BtnPost").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var txtTitle = $("#title").val();
                var $txt_content = $("#content").val();
                var txtID = $("#id").val();
				

                if (txtTitle == null || txtTitle == "") {
                    alert(alertNotice);
                    $("#category").focus();
                }
                

                else {
                    
                    $.post("process.posts.php", {
                        title: txtTitle,
                        content: $txt_content,
                        postID: txtID
                    }, function(data,status) {
                        
						if(status == "success"){
                        window.location = "dashboard.php";
						}
                    })
                }
            });


    </script>

<?php
include("admin.footer.php");
