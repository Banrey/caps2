<?php

include("admin.header.php");
if(!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

$txt_send = "";
$txt_receive = "";
$txt_message = "";
$txt_id = "";

if (@$_GET["action"] == "update"){
	$sql_chat = "SELECT sendID, receiveID, message FROM tblchats WHERE chatID = ?";

    if ($chat_check = mysqli_prepare($conn, $sql_chat)){
        mysqli_stmt_bind_param($chat_check, "i", $id,);
        
        $id = $_GET['chatID'];

        mysqli_stmt_execute($chat_check);
        
        mysqli_stmt_bind_result($chat_check, $sendID, $receiveID, $message);
        while(mysqli_stmt_fetch($chat_check)){
			
           $txt_send = $sendID;
		   $txt_receive = $receiveID;
		   $txt_message = $message;
		   $txt_id = $_GET['chatID'];

            
        }
    }

}
?>



<div class="container my-2 border">
    <div class="row">
        <div class="col-sm-12 ">
			<div class="row">
				<h3>Chats</h3>
				<div class="col-sm-3 ">
					<div class="form-group">
										<label>Send ID</label>   
										<input value="<?php echo $txt_send; ?>" type="text" id="sendID" class="form-control rounded" placeholder="Send ID" > 
									
					</div>
            	</div>

				<div class="col-sm-3 ">
					<div class="form-group">
											<label>Receive ID</label>   
											<input value="<?php echo $txt_receive; ?>" type="text" id="receiveID" class="form-control rounded" placeholder="Receive ID" > 
										
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
						<input type="hidden" value="<?php echo $txt_id; ?>" id="chatID" >
						<button type="button" id="BtnComment" class="btn btn-warning btn-block float-end">Save Chat</button>
										
					</div>
            	</div>
			</div>
        </div>
    </div>
        <divdiv class="row overflow-auto p-2" style="max-height: 500px;">
            <div class="col-sm-12 mh-50 overflow-auto">
				<table border="1" class="table table-striped">
					<thead>
						<tr> 
							<td width= "15%">Action</td>
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
							<td> <a href="chats.php?action=update&chatID=<?php echo $get_chat["chatID"] ?>"> 
							Update</a> /
							<a href="process.chats.php?action=delete&chatID=<?php echo $get_chat["chatID"] ?>">
							Delete</a>
							</td>
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
        $("#BtnComment").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

				var chatID = $("#chatID").val();
                var receiveID = $("#receiveID").val();
                var message = $("#message").val();
                var sendID = $("#sendID").val();
				

                if (sendID == null || sendID == "") {
                    alert(alertNotice);
                    $("#sendID").focus();
                }
                else if (message == null || message == "") {
                    alert(alertNotice);
                    $("#message").focus();
                }
                else if (receiveID == null || receiveID == "") {
                    alert(alertNotice);
                    $("#receiveID").focus();
                }
                

                else {
                    
                    $.post("process.chats.php", {
                        chatID: chatID,
                        receiveID: receiveID,
                        message: message,
						sendID: sendID
                    }, function(data,status) {
						console.log(data);
                        
						if(status == "success"){
                        window.location = "chats.php";
						}
                    })
                }
            });


    </script>

<?php
include("admin.footer.php");
