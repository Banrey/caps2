<?php include("header.php");

?>

<!-- navbar Starts here -->
<?php if(empty($_SESSION["accID"])){
    include("navbarHead.php");
} else{include("navbarLogged.php");}
        
        ?>

            <!---->
            <div class="col-sm-8 mx-3 my-4">
                            <div class="card">
                                    <div class="card-header">
                                        Make a post

                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Post Title*</label>   
                                            <input type="text" id="Title" class="form-control rounded" placeholder="Insert Post Title Here" > 
                                        </div>

                                        <div class="form-group ">
                                            <label>Content*</label>   
                                            <textarea id="Content" class="form-control" rows="12" placeholder="What do you want to talk about?" ></textarea>
                                            
                                        </div>

                                        <div class="form-group py-2 float-end">
                                            <button type="button" id="BtnPost" class="btn btn-primary btn-block">Post</button>
                                            
                                        </div>
                                    </div>
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