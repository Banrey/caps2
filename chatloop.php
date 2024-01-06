<?php $sql_chat = "
SELECT ch.chatID, ch.sendID, ch.receiveID, ch.message, us.username AS sendname, ur.username AS receivename 
FROM tblchats AS ch 
JOIN 
    tblusers AS us ON ch.sendID = us.accID 
JOIN 
    tblusers AS ur ON ch.receiveID = ur.accID 
WHERE (ch.receiveID = ".$_SESSION["accID"]." AND ch.sendID = ". $_REQUEST["friendID"] .") OR (ch.sendID = ".$_SESSION["accID"]." AND ch.receiveID = ". $_REQUEST["friendID"] . ")"." 
ORDER BY chatID ASC;
"
                            ?>    

        
                            
        <?php $qry_chat = mysqli_query($conn, $sql_chat); ?>
		<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
            
            <div class="card col-md-12 px-auto my-1 overflow-auto">
            <div class="card-header">
                <h5 class="card-title">to: <?php echo $get_chat["receivename"] ?></h5>
                
                <div style="height: 100px;"class="card-body">
                    <p><?php echo $get_chat["message"] ?></p>
                     
                </div>
            </div>
            <div class="card-footer">from: <?php 
                    $sndID = $get_chat["sendname"];
                    if(is_null($sndID)){
                        echo "guest";
                    } 
                    
                    else {echo $sndID; }?> </div>
            </div>
            <?php } ?>