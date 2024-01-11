<?php 
include("header.php");
include("connCheck.php");

?>

<!-- navbar Starts here -->
<?php if(empty($_SESSION["accID"])){
    include("navbarHead.php");
} else{include("navbarLogged.php");}
        
        ?>

<?php $sql_posts = "
                            SELECT title, content, datePosted, status
                            FROM
                            posts 
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
                                            <select name="Status" id="status">
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
                        <?php } ?>

                        <div class="col-sm-8 mx-3 my-4">
                            <div class="card">
                                    <div class="card-header">
                                        Rate Comments

                                    </div>
                                    <div class="card-body"></div>
                            </div>
                        </div>
                    

            <?php 
        include("navbarfoot.php");        
        ?>

<!-- navbar ends here -->

            <script language="javascript">
		
        $("#BtnPost").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var title = $("#Title").val();
                var content = $("#Content").val();

                if (title == null || title == "") {
                    alert(alertNotice);
                    $("#Title").focus();
                }
                
                else if (content == null || content == "") {
                    alert(alertNotice);
                    $("#Content").focus();
                }

                else {
                    
                    $.post("process.post.php", {
                        title: title,
                        content: content
                    }, function(data,status) {
						if(status == "success"){
                        alert("Posted Successfully");
                        window.location = "forum.php";
						}
                    })
                }
            });


    </script>