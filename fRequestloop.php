<?php 
$sql_chat = "SELECT f.requestID, u.username, u.accID
    FROM
    tblfriendrequest AS f,
    tblusers AS u 
    WHERE (f.status = 'Pending' AND f.receiveID = ".$_SESSION['accID']." AND f.senderID = u.accID)"
                            
                            ?>    
                                        
        <?php $qry_chat = mysqli_query($conn, $sql_chat);
        if(mysqli_num_rows($qry_chat) == 0){
            
            ?>
            <div class="col-md-9 card my-3">
            <div class="card-body"><?php  echo "No Friend Requests";?></div></div>
            <?php 
         }
         else{
        ?>
        
		<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
            <div class="col-md-9 card my-3">
                <div class="card-body">
                <?php echo $get_chat["username"]; ?>
                <a class ="float-end mx-2" href=<?php echo "process.friendRequest.php?requestID=".$get_chat["requestID"]."&action=reject"?>> Reject</a>
                <a class ="float-end mx-2" href=<?php echo "process.friendRequest.php?requestID=".$get_chat["requestID"]."&action=accept"?>>Accept </a>

                </div>

            </div>
            
            
            <?php } }?>