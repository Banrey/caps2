<?php 
include("header.php");
include("connCheck.php");

?>

<link rel="stylesheet" type="text/css" href="rate.css">

<!-- navbar Starts here -->
<?php if(empty($_SESSION["accID"])){
    include("navbarHead.php");
} else{include("navbarLogged.php");}
        
        ?>

<?php $sql_posts = "
                            SELECT title, content, datePosted, status
                            FROM
                            companyposts 
                            WHERE postID =".$_GET['postID'];			
                            ?> 

<?php $qry_posts = mysqli_query($conn, $sql_posts); ?>
		<?php while($get_posts = mysqli_fetch_array($qry_posts)){ ?>

            <!---->
            <div class="col-sm-8 mx-3 my-4">
                            <div class="card">
                                    <div class="card-header">
                                        Edit Your Post

                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Post Title*</label>   
                                            <input type="text" id="Title" class="form-control rounded" value = <?php echo '"'.$get_posts["title"].'"'; ?> > 
                                        </div>
                                        <div class="form-group">
                                            <label>Post Title*</label>   
                                            <select name="Status" id="Status">
                                                <?php if ($get_posts["status"]== "solved") { ?>
                                                    <option value="solved">Solved</option>
                                                    <option value="unsolved">Unsolved</option>
                                                <?php } else{?> 
                                                    <option value="unsolved">Unsolved</option>
                                                    <option value="solved">Solved</option>

                                                    <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group ">
                                            <label>Content*</label>   
                                            <textarea id="Content" class="form-control" rows="12" ><?php echo $get_posts['content']; ?></textarea>
                                            
                                        </div>

                                        <div class="form-group py-2 float-end">
                                            <button type="button" id="BtnPost" class="btn btn-primary btn-block">Save Changes</button>
                                            
                                        </div>
                                    </div>
                            </div>        
                        </div>

                        
                        <div class="col-sm-8 mx-3 my-4">
                            <div class="card">
                                    <div class="card-header">
                                        Rate Comments

                                    </div>
            <div class="card overflow-auto" style="max-height: 200px" <?php echo 'id="comment_container'."\"" ?>>                 
                <!--Comments go here-->
                <?php $sql_comment = "
                            SELECT co.commentID, co.postID, co.accID, co.message, co.rating, us.username 
                            FROM companycomments AS co 
                            JOIN tblusers AS us ON co.accID = us.accID
                            WHERE co.postID = ".$_GET["postID"]							
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
                        <label for="<?php echo $get_comment["commentID"] ?>_star5" title="text">5 stars</label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star4" name="rate<?php echo $get_comment["commentID"] ?>" value="5" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star4" title="text">4 stars</label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star3" name="rate<?php echo $get_comment["commentID"] ?>" value="4" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star3" title="text">3 stars</label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star2" name="rate<?php echo $get_comment["commentID"] ?>" value="3" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star2" title="text">2 stars</label>
                        <input class=<?php echo $get_comment["commentID"] ?> type="radio" id="<?php echo $get_comment["commentID"] ?>_star1" name="rate<?php echo $get_comment["commentID"] ?>" value="2" />
                        <label for="<?php echo $get_comment["commentID"] ?>_star1" title="text">1 star</label>
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
                        <?php } ?>

                    

            <?php 
        include("navbarfoot.php");        
        ?>

<!-- navbar ends here -->

            <script language="javascript">
                
                var pID = <?php echo $_GET['postID']?>;
		
        $("#BtnPost").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var title = $("#Title").val();
                var content = $("#Content").val();
                var status = $("#Status").val();

                if (title == null || title == "") {
                    alert(alertNotice);
                    $("#Title").focus();
                }
                
                else if (content == null || content == "") {
                    alert(alertNotice);
                    $("#Content").focus();
                }
                
                else if (status == null || status == "") {
                    alert(alertNotice);
                    $("#Status").focus();
                }

                else {
                    
                    $.post("process.editCPost.php", {
                        title: title,
                        content: content,
                        status: status,
                        postID: pID
                    }, function(data,status) {
						if(status == "success"){
                        alert(pID);
                        window.location = "editPost.php?postID=" + pID;
						}
                    })
                }
            });

            var x = document.querySelectorAll("input");

            x.forEach(function(radio) {
    radio.addEventListener('click', function() {        
                
                var commentID = this.className;
                var rating = this.value;
                alert(rating);
                
                $.post("process.editCPost.php?action=rate", {
                        rating: rating,
                        commentID: commentID

                    }, function(data,status) {
						if(status == "success"){
                        window.location = "editPost.php?postID=" + pID;
						}
                    })
        
    });
});

            



    </script>