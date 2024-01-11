<?php 
$sql_chat = "SELECT postID, title, content, status
    FROM
    posts 
    WHERE accID = ".$_SESSION["accID"]
                            
                            ?>    
                                        
        <?php $qry_chat = mysqli_query($conn, $sql_chat);
        if(mysqli_num_rows($qry_chat) == 0){
            
            ?>
            <div class="col-md-9 card my-3">
            <div class="card-body"><?php  echo "No Posts";?></div></div>
            <?php 
         }
         else{
        ?>
        
		<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
            <div class="col-md-9 card my-3">
                <div class="card-header">
                <p class="mx-4"><?php echo $get_chat["title"]; ?> </p>
                <?php echo "Current status: ".$get_chat["status"]; ?> 
                <a class="mx-3 float-end" href=<?php echo "process.myPosts.php?postID=".$get_chat["postID"]."&action=solved"?>> Solved</a>
                <a class="float-end" href=<?php echo "process.myPosts.php?postID=".$get_chat["postID"]."&action=unsolved"?>>Unsolved </a>

                </div>
                <div class="card-body">
                <?php echo $get_chat["content"]; ?>                  
            

                </div>

            </div>
            
            
            <?php } }?>