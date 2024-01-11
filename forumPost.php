
        <?php $qry_posts = mysqli_query($conn, $sql_posts); ?>
		<?php while($get_posts = mysqli_fetch_array($qry_posts)){ ?>
						

                    <!--Post contents-->    
    <div class="container mt-5">  
        <div class="col-sm-8">
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
            <div class="col-sm-auto">
                <div class="card h-22">                  
                    <div class="card-body">     
                        <form method="post" id="comment_form">
                        <textarea class="form-control" placeholder="insert comment here" name="comment" id="comment" ></textarea>                    
                        <button type="button" class="btn btn-primary float-end my-3 btncmnt"  <?php echo 'id="BtnComment'.$get_posts["postID"]."\"".' name ="'.$get_posts["postID"]."\"".' value ="'.$get_posts["postID"]."\"" ?> class="float-end btn btn-primary mt-3 mx-auto">Comment</button>         
                    </form>                   
                                  
                    </div>
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
		<?php while($get_comment = mysqli_fetch_array($qry_comment)){ ?>
            <div class="card col-12 px-2 overflow-auto">
                <h6><?php echo $get_comment["username"] ?></h6>
               
                <div style="height: 50px;">
                        <p><?php echo $get_comment["message"] ?></p>   
                    </div>
            </div>
            <?php } ?>
            </div>
        </div>            
    </div>
    <!--One Entry-->
    <?php } ?>