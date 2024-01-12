

<link rel="stylesheet" type="text/css" href="rateNoHover.css">
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
                            SELECT co.commentID, co.postID, co.accID, co.message, co.rating, us.username 
                            FROM companycomments AS co 
                            JOIN tblusers AS us ON co.accID = us.accID
                            WHERE co.postID = ".$get_posts["postID"]							
                            ?>      
        <?php $qry_comment = mysqli_query($conn, $sql_comment); ?>
		<?php if (mysqli_fetch_array($qry_comment) > 0) {
            
         $qry_comment = mysqli_query($conn, $sql_comment); 
            while($get_comment = mysqli_fetch_array($qry_comment)) { ?>
                <div class="card col-12 px-2 overflow-auto">
                    <div class="container d-inline-block">
                        
                    <h6 class="float-start my-3"><?php echo $get_comment["username"] ?></h6> 
                    <div class="rate float-end">
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star5" name="rate<?php echo $get_comment["commentID"] ?>" value="6" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star5" title="Rated 5 stars by Poster"></label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star4" name="rate<?php echo $get_comment["commentID"] ?>" value="5" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star4" title="Rated 4 stars by Poster"></label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star3" name="rate<?php echo $get_comment["commentID"] ?>" value="4" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star3" title="Rated 3 stars by Poster"></label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star2" name="rate<?php echo $get_comment["commentID"] ?>" value="3" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star2" title="Rated 2 stars by Poster"></label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star1" name="rate<?php echo $get_comment["commentID"] ?>" value="2" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star1" title="Rated 1 stars by Poster"></label>
                    </div>

                    <script>
                        var rating = <?php echo $get_comment["rating"] ?>;
                        switch(rating) {
                        case 1:
                            document.getElementById("<?php echo $get_comment["commentID"] ?>_star1").checked = true;
                            break;
                        case 2:
                            document.getElementById("<?php echo $get_comment["commentID"] ?>_star2").checked = true;
                            break;
                        case 3:
                            document.getElementById("<?php echo $get_comment["commentID"] ?>_star3").checked = true;
                            break;
                        case 4:
                            document.getElementById("<?php echo $get_comment["commentID"] ?>_star4").checked = true;
                            break;
                        case 5:
                            document.getElementById("<?php echo $get_comment["commentID"] ?>_star5").checked = true;
                            break;
                        default:
                            // code block
                    
                        }
                        $( document ).ready(function() {
                            var rad = document.querySelectorAll("input");

                            rad.forEach(radio => radio.disabled = true);
                        });
                       
                    </script>

                    </div>
                   
                    <div style="height: 50px;" class=" mx-2">
                            <p><?php echo $get_comment["message"] ?></p>   
                        </div>
                </div>
                <?php } 
           
        } else { ?> 
           
            <div style="height: 50px;" class="card-body">
                    <p><?php echo "No comments for this post" ?></p>   
                </div>
        <?php } ?>
                            </div>
                        </div>
					</div>
                        <?php } ?>
            </div>
        </div>            
    </div>
    <!--One Entry-->