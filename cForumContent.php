<?php 
include("header.php");
?>
<!-- forum starts here -->
<?php $sql_cname = "
                            SELECT companyName
                            FROM
                            tblcompanynames 
                            WHERE companyID = ".$_SESSION['companyID']					
                            ?>  
                            <?php $qry_cname = mysqli_query($conn, $sql_cname); ?>
                            <?php $get_cname = mysqli_fetch_array($qry_cname) ?>
<h1><?php echo "Welcome to ".$get_cname['companyName']." company forums"; ?></h1>
<div id="post_container">
    <a href="company_post.php">
    <button type="button" id="BtnPost" class="btn btn-primary mt-3 mx-auto">New Post</button></a>
    
    <!--One Entry-->
    <?php $sql_posts = "
                            SELECT title, content, postID
                            FROM
                            companyposts 
                            WHERE companyID = ".$_SESSION['companyID']."
                            ORDER BY postID DESC"							
                            ?>      
        <?php $qry_posts = mysqli_query($conn, $sql_posts); ?>
		<?php while($get_posts = mysqli_fetch_array($qry_posts)){ ?>
						

<!--One Entry-->                        
    <div class="container mt-5">  
        <div class="col-sm-11">
            <div class="card">
                <div class="card-header">
                    <p><?php echo $get_posts["title"] ?></p>
                    <div style="height: 200px;"class="card-body">
                        <p><?php echo $get_posts["content"] ?></p>   
                    </div>
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="card h-22">                  
                    <div class="card-body">                        
                        <textarea class="form-control" placeholder="insert comment here" name="comment" id="comment" ></textarea>                    
                        <button type="button" onclick="comment(this)" <?php echo 'id="BtnComment'.$get_posts["postID"]."\"".' name ="'.$get_posts["postID"]."\"" ?> class="float-end btn btn-primary mt-3 mx-auto">Comment</button>                    
                    </div>
                </div>
            </div>
            <div class="card overflow-auto" style="max-height: 200px" <?php echo 'id="comment_container'.$get_posts["postID"]."\"" ?>>                 
                <!--Comments go here-->
                <?php $sql_comment = "
                            SELECT co.commentID, co.postID, co.accID, co.message, us.username 
                            FROM companycomments AS co 
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
    <?php
            include("footer.php");
            ?>
</div>
<!-- forum ends here -->

    


<script lang="javascript">
function comment(button){
    textarea = button.previousElementSibling
    message = textarea.value     
    
    
    postID = button.getAttribute("name")
    if (message == null || message == "") {
                    alert(alertNotice);
                    $(txtArea).focus();
                }

    else{
        $.post("process.companyComment.php", {
                        message: message,
                        postID: postID
                    }, function(data,status) {
						if(status == "success"){
                        alert("Commented Successfully");                                            
                        window.location = "companyForum.php";
						}
                    })
    }  
}
 
</script>