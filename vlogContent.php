<?php 
include("header.php");
?>
<!-- forum starts here -->
<div id="post_container">
        <?php
        if (!empty($_SESSION['username'])) {?>
            
    <a href="vlog_form.php">
            <button type="button" id="BtnPost" class="btn btn-primary mt-3 mx-auto">Post your Vlog</button></a>
       <?php }
        ?>
    
    <!--One Entry-->
    <?php $sql_vlogs = "
                            SELECT vlogID, accID, title, link , description
                            FROM
                            vlogs 
                            
                            ORDER BY vlogID DESC"							
                            ?>      
        <?php $qry_vlogs = mysqli_query($conn, $sql_vlogs); ?>
		<?php while($get_vlogs = mysqli_fetch_array($qry_vlogs)){ ?>
            <!--Comments go here-->					

                        
    <div class="container mt-5">  
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <p><?php echo $get_vlogs["title"] ?></p>                 
                </div>

                <div style="height: 400px;"class="card-body">
                    <iframe width="420" height="315"
                        src="https://www.youtube.com/embed/<?php echo $get_vlogs["link"]?>">
                    </iframe>
                    </div>

                <div class="d-flex card-footer">
                    <p><?php echo $get_vlogs["description"]; ?></p>
                        
                </div>
            </div>
            <div class="col-sm-auto">
                <div class="card h-22">                  
                    <div class="card-body">                        
                        <textarea class="form-control" placeholder="insert comment here" name="comment" id="comment" ></textarea>                    
                        <button type="button" onclick="comment(this)" <?php echo 'id="BtnComment'.$get_vlogs["vlogID"]."\"".' name ="'.$get_vlogs["vlogID"]."\"" ?> class="float-end btn btn-primary mt-3 mx-auto">Comment</button>                    
                    </div>
                    
                </div>
            </div>
            <div class="card overflow-auto" style="max-height: 200px" <?php echo 'id="comment_container'.$get_vlogs["vlogID"]."\"" ?>>                 
                <!--Comments go here-->
                <?php $sql_comment = "
                            SELECT co.commentID, co.vlogID, co.accID, co.message, us.username 
                            FROM vcomments AS co 
                            JOIN tblusers AS us ON co.accID = us.accID
                            WHERE co.vlogID = ".$get_vlogs["vlogID"]							
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
    
    
    vlogID = button.getAttribute("name")
    if (message == null || message == "") {
                    alert(alertNotice);
                    $(txtArea).focus();
                }

    else{
        $.post("process.vcomment.php", {
                        message: message,
                        vlogID: vlogID
                    }, function(data,status) {
						if(status == "success"){
                        alert("Commented Successfully");                                            
                        window.location = "vlog.php";
						}
                    })
    }  
}


    
</script>

