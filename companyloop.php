<?php $sql_cname = "
                            SELECT companyID, companyName
                            FROM tblcompanynames 
                            ORDER BY companyID ASC"
                            ?>    

        
                            
        <?php $qry_cname = mysqli_query($conn, $sql_cname); ?>
		<?php while($get_cname = mysqli_fetch_array($qry_cname)){ ?>
            
            <option value =<?php echo $get_cname["companyID"]; ?>><?php echo $get_cname["companyName"]; ?></option>
            <?php } ?>