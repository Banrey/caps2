<?php 
include("header.php");
?>
<!-- forum starts here -->
<div id="post_container">
    
    <div class="container mb-2">
<h1>Welcome to Superphishal</h1>
        <?php if (!empty($_SESSION['username'])) {?>
            
            <a href="post_form.php">
        
        <button type="button" id="BtnPost" class="btn btn-primary mt-3 mx-auto">New Post</button></a>
       <?php }?>



<?php $sql_solved = "
                        SELECT count(status) AS ctr
                        FROM
                        posts 
                        
                        WHERE status = 'solved'"							
                        ?>    
                        
    <?php $qry_solved = mysqli_query($conn, $sql_solved); ?>
    <?php while($get_solved = mysqli_fetch_array($qry_solved)){ ?>
        <h3 class="float-end"> Solved Issues:<?php echo $get_solved["ctr"]?></h3>
        
    </div>
        <?php } ?>

    
    <!--One Entry-->
    <?php $sql_posts = "
                            SELECT title, content, postID , status
                            FROM
                            posts 
                            
                            ORDER BY postID DESC"							
                            ?>    
                            
        <?php $qry_posts = mysqli_query($conn, $sql_posts); ?>
		<?php while($get_posts = mysqli_fetch_array($qry_posts)){ ?>
						

                        
    <div class="container mt-5">  
        <div class="col-sm-8">
            <div class="card">
                <div class="card-header">
                    <p class = "float-end"><?php echo $get_posts["status"] ?></p> 
                    <p><?php echo $get_posts["title"] ?></p> 
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
                        <button type="button" class="btn btn-primary float-end my-3"  <?php echo 'id="BtnComment'.$get_posts["postID"]."\"".' name ="'.$get_posts["postID"]."\"".' value ="'.$get_posts["postID"]."\"" ?> class="float-end btn btn-primary mt-3 mx-auto">Comment</button>         
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
    <?php
            include("footer.php");
            ?>
</div>
<!-- forum ends here -->

    


<script lang="javascript">
    
    var conn = new WebSocket('ws://localhost:8080');
    var comment_data;
    
 $(document).ready(function () {
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

        conn.onmessage = function(e) {
        //console.log(e.data);

        var data = JSON.parse(e.data);

        let idTxt = '#'.concat('comment_container',data.postID); 

        let html_data = `<div class="card col-12 px-2 overflow-auto">
                <h6>${data.username}</h6>
               
                <div style="height: 50px;">
                        <p>${data.message}</p>   
                    </div>
            </div>`;
        
        $(idTxt).append(html_data);
        };

 });

const buttons = document.querySelectorAll(".btn");

// loop through each button and add a click event listener
buttons.forEach(function(button) {
  button.addEventListener("click", function() {
    event.preventDefault();
    // do something when the button is clicked
    
    alertNotice = "Invalid Input";
    textarea = button.previousElementSibling
    message = textarea.value     
    postID = button.getAttribute("name")
    username = <?php if (isset($_SESSION['username'])) {
        echo '"'.$_SESSION['username'].'"';
    } 
    else {echo '"guest"';}?>

    
    var comment = {
        message: message,
        postID: postID,
        username: username        
    }
    console.log(JSON.stringify(comment));
    comment_data = JSON.stringify(comment);
    let idTxt = '#'.concat('comment_container',postID); 

        let html_data = `<div class="card col-12 px-2 overflow-auto">
                <h6>${username}</h6>
               
                <div style="height: 50px;">
                        <p>${message}</p>   
                    </div>
            </div>`;
        
        $(idTxt).append(html_data);
        

    if (message == null || message == "") {
                    alert(alertNotice);
                    $(textarea).focus();
                }

    else{

        $.post("process.comment.php", {
                        message: message,
                        postID: postID
                    }, function(data,status) {
						if(status == "success"){
                        alert("Commented Successfully");      
                        textarea.value="";      
						}
                    })
    }  
        });
    });

    
 $('.btn').on('click', function () {
    
    conn.send(comment_data);
    
    var data = JSON.parse(comment_data);

let idTxt = '#'.concat('comment_container',data.postID); 
$(idTxt).scrollTop($(idTxt)[0].scrollHeight);


 });



</script>

