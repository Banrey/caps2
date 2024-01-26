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
    <button type="button" id="BtnPost" class="btn btn-primary mt-3 mx-4">New Post</button></a>

    
<?php $sql_solved = "
                        SELECT count(status) AS ctr
                        FROM
                        companyposts 
                        
                        WHERE status = 'solved'"							
                        ?>    
                        
    <?php $qry_solved = mysqli_query($conn, $sql_solved); ?>
    <?php while($get_solved = mysqli_fetch_array($qry_solved)){ ?>
        <h3 class="float-end"> Queries Answered:<?php echo $get_solved["ctr"]?></h3>
        
    </div>
        <?php } ?>
    
    <!--One Entry-->
    <?php $sql_posts = "
                            SELECT title, content, postID, datePosted, status
                            FROM
                            companyposts 
                            WHERE companyID = ".$_SESSION['companyID']."
                            ORDER BY postID DESC"							
                            ?>    
    <?php
            include("footer.php");
            include("cforumPost.php");
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

        $.post("process.companyComment.php", {
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
    
    window.location = "company_post.php";


 });



</script>

