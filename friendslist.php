<?php 
include("connCheck.php");

include("header.php");

session_start();
include("requireLogin.php");
?>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<!-- navbar Starts here -->
<?php if(empty($_SESSION["accID"])){
    include("navbarHead.php");
} else{
    if(!empty($_SESSION["companyID"])){
        include("navbarCompany.php");

    }
    else{include("navbarLogged.php");}
    }
        
        ?>

            <!---->
<div class="container-fluid py-2">
                    <label for="recipient" class="mx-3">Friend List</label>
                    <select class="js-example-basic-single col-3" name="users[]" id="friend">
                    <?php
                        include("selectloop.php");
                    ?> 
</select>
<button type="button" id="BtnAddFriend" class="btn btn-primary mt-3 mx-3 my-3">Send Friend Request</button>
                   
                    
                    <div class="container-fluid col-lg-10 mx-2">
                            <?php
                                include("friendloop.php");
                            ?>         
                    </div>
                </div>

                
<div class="container-fluid py-2">
                    <label for="recipient">Friend Requests</label>
                   
                    
                    <div class="container-fluid col-lg-10 mx-2">
                            <?php
                                include("fRequestloop.php");
                            ?>         
                    </div>
                </div>

                <?php 
        include("navbarfoot.php");        
        ?>
                <?php 
include("footer.php");
?>

<script language="javascript">
		
        $("#BtnAddFriend").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var friend = $("#friend").val();

                if (friend == null || friend == "") {
                    alert(alertNotice);
                    $("#friend").focus();
                }
                
                
                else {
                    
                    $.post("process.addFriend.php", {
                        friendID: friend
                    }, function(data,status) {                      
                    
						if(status == "success"){  
                            alert(data);
							
                        
                        
						} 
                    })
                }
            });


    </script>