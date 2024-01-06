<?php $sql_chat = "
                            SELECT *
                            FROM tblusers 
                            ORDER BY accID DESC"
                            ?>    

        
                            
        <?php $qry_chat = mysqli_query($conn, $sql_chat); ?>
		<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
            
            <option value =<?php echo $get_chat["accID"]; ?>><?php echo $get_chat["username"]; ?></option>
            <?php } ?>