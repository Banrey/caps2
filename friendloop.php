<?php $sql_chat = "SELECT
    *
FROM
    tblfriendrequest AS f,
    tblusers AS u WHERE f.status = 'Accepted' AND (CASE WHEN f.senderID = ".$_SESSION['accID']." THEN f.receiveID = u.accID WHEN f.receiveID = ".$_SESSION['accID']." THEN f.senderID = u.accID END);"
                            
                            ?>    

        <?php $qry_chat = mysqli_query($conn, $sql_chat); 
        if(mysqli_num_rows($qry_chat) == 0){
            
            ?>
            <div class="col-md-9 card my-3">
            <div class="card-body"><?php  echo "No Friends :(";?></div></div>
            <?php 
         }
         else{?>
		<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
            <div class="col-md-9 card">
                <div class="card-body">
                    
            <?php echo $get_chat["username"]; ?> <a class ="float-end mx-2" href=<?php echo "chat.php?friendID=".$get_chat["accID"]?>>Chat</a>

                </div>

            </div>
            
            
            <?php } }?>