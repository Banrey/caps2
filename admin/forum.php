<?php 


include("admin.header.php");

include("../connect.php");
?>

<div id="post_container">
    <a href="post_form.php">
    <button type="button" id="BtnPost" class="float-end btn btn-primary mt-3 mx-auto">New Post</button></a>
    
    <!--One Entry-->
    <?php $sql_posts = "
                            SELECT * 
                            FROM
                            posts "							
                            ?>      
        <?php $qry_posts = mysqli_query($conn, $sql_posts); ?>
		<?php while($get_posts = mysqli_fetch_array($qry_posts)){ ?>
						

                        
    <div class="container mt-5">  
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <p><?php echo $get_posts["title"] ?></p>
                    <div style="height: 200px;"class="card-body">
                        <p><?php echo $get_posts["content"] ?></p>   
                    </div>
                </div>
            </div>
            
            
        </div>            
    </div>
    <!--One Entry-->
    <?php } ?>
    
</div>
    


<script lang="javascript">
function comment(button){
    textarea = button.previousElementSibling
    message = textarea.value     
    <?php 
    if (empty($_SESSION['accID'])) {
        $phpaccID = null;
        echo 'accID = '.$phpaccID;
    
    }
    else{
        $phpaccID = $_SESSION['accID'];
        echo 'accID = '.$phpaccID;}
    ?>
    
    postID = button.getAttribute("name")
    if (message == null || message == "") {
                    alert(alertNotice);
                    $(txtArea).focus();
                }

    else{
        $.post("process.comment.php", {
                        message: message,
                        postID: postID,
                        accID: accID
                    }, function(data,status) {
						if(status == "success"){
                        alert("Commented Successfully");                                            
                        window.location = "forum.php";
						}
                    })
    }  
}
 
</script>