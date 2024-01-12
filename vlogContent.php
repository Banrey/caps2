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
                        <button type="button" onclick="comment(this)" <?php echo 'id="BtnComment'.$get_vlogs["vlogID"]."\"".' name ="'.$get_vlogs["vlogID"]."\"" ?> class="float-end btn btn-primary btncmnt mt-3 mx-auto">Comment</button>                    
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
    
    var conn = new WebSocket('ws://localhost:8080');
    var comment_data;
    
 $(document).ready(function () {
		conn.onopen = function(e) {
		    console.log("Connection established!");
		};

        conn.onmessage = function(e) {
        //console.log(e.data);

        var data = JSON.parse(e.data);

        let idTxt = '#'.concat('comment_container',data.vlogID); 

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
    vlogID = button.getAttribute("name")
    username = <?php if (isset($_SESSION['username'])) {
        echo '"'.$_SESSION['username'].'"';
    } 
    else {echo '"guest"';}?>

    
    var comment = {
        message: message,
        vlogID: vlogID,
        username: username        
    }
    console.log(JSON.stringify(comment));
    comment_data = JSON.stringify(comment);
    let idTxt = '#'.concat('comment_container',vlogID); 

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

        $.post("process.vcomment.php", {
                        message: message,
                        vlogID: vlogID
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

let idTxt = '#'.concat('comment_container',data.vlogID); 
$(idTxt).scrollTop($(idTxt)[0].scrollHeight);


 });

 $('#BtnPost').on('click', function () {
    
    window.location = "company_post.php";


 });



</script>

