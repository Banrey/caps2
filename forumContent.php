<?php 
include("header.php");
?>
<!-- forum starts here -->
<div id="post_container" class="d-inline-block col-12">
    
    <div class="container mb-2">
<h1>Welcome to Superphishal</h1>
            
            <a href="post_form.php">
        
        <button type="button" id="BtnPost" class="btn btn-warning mt-3 mx-auto" tabindex="3">New Post</button>
    </a>



<?php $sql_solved = "
                        SELECT count(status) AS ctr
                        FROM
                        posts 
                        
                        WHERE status = 'solved'"							
                        ?>    
                        
    <?php $qry_solved = mysqli_query($conn, $sql_solved); ?>
    <?php while($get_solved = mysqli_fetch_array($qry_solved)){ ?>
        <h3 class="float-end"> Queries Answered:<?php echo $get_solved["ctr"]?></h3>
        
    </div>
        <?php } ?>

    
    <!--One Entry-->
    <?php $sql_posts = "
                            SELECT title, content, postID , status, datePosted
                            FROM
                            posts 
                            
                            ORDER BY postID DESC"							
                            ?>    
                            
    <?php
            include("forumPost.php");
            
            
            include("navbarfoot.php");
            
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
                        textarea.value="";      
						}
                    })
    }  
        });
    });

    
    $('.btncmnt').on('click', function () {
    
    conn.send(comment_data);
    
    var data = JSON.parse(comment_data);

let idTxt = '#'.concat('comment_container',data.postID); 
$(idTxt).scrollTop($(idTxt)[0].scrollHeight);


 });

 $('#BtnPost').on('click', function () {
    
    window.location = "post_form.php";


 });



</script>

