<?php 
$sql_posts = "SELECT postID, title, content, status, datePosted
    FROM
    posts 
    WHERE accID = ".$_SESSION["accID"]
                            
                            ?>    
                                        
        <?php $qry_posts = mysqli_query($conn, $sql_posts);
        if(mysqli_num_rows($qry_posts) == 0){
            
            ?>
            <div class="col-md-9 card my-3">
            <div class="card-body"><?php  echo "No Posts";?></div></div>
            <?php 
         }
         else{
        ?>
        
		<?php while($get_posts = mysqli_fetch_array($qry_posts)){ ?>
            <div class="container mt-5">  
        <div class="col-sm-8">
            <a href=<?php echo 'editPost.php?postID='.$get_posts["postID"];?>>Edit Post</a>
            <div class="card">
                <div class="card-header">
                    <p class = "float-right"><?php echo "Posted ".$get_posts["datePosted"] ?></p>
                    <p class = "float-end">This problem is <?php echo $get_posts["status"] ?></p> 
                    <h5><?php echo $get_posts["title"] ?></h5> 
                </div>
                    <div style="height: 200px;"class="card-body">
                        <p><?php echo $get_posts["content"] ?></p>   
                    </div>
            </div>
            <div class="card overflow-auto" style="max-height: 200px" <?php echo 'id="comment_container'.$get_posts["postID"]."\"" ?>>                 
                <!--Comments go here-->
                <?php $sql_comment = "
                            SELECT co.commentID, co.postID, co.accID, co.message, us.username 
                            FROM comments AS co 
                            JOIN tblusers AS us ON co.accID = us.accID
                            WHERE co.postID = ".$get_posts["postID"]							
                            ?>      
        <?php $qry_comment = mysqli_query($conn, $sql_comment); ?>
		<?php if (mysqli_fetch_array($qry_comment) > 0) {
            while($get_comment = mysqli_fetch_array($qry_comment)){ ?>
                <div class="card col-12 px-2 overflow-auto">
                    <h6><?php echo $get_comment["username"] ?></h6>
                   
                    <div style="height: 50px;">
                            <p><?php echo $get_comment["message"] ?></p>   
                        </div>
                </div>
                <?php } 
           
        } else { ?> 
           
            <div style="height: 50px;" class="card-body">
                    <p><?php echo "No comments for this post" ?></p>   
                </div>
        <?php }?>
            </div>
        </div>            
    </div>
            
            
            <?php } }?>