<?php include("header.php");
session_start();
include("connCheck.php");
?>


            <!---->
            <?php if(empty($_SESSION["accID"])){
    include("navbarHead.php");
} else{
    if(!empty($_SESSION["companyID"])){
        include("navbarCompany.php");

    }
    else{ include("navbarLogged.php"); }}
            ?>

            <div class="col py-3"> 
            <div class="col-sm-8 mx-3 my-4">
				<div class="card">
						<div class="card-header">
							Make a Vlog post

						</div>
						<div class="card-body">
							<div class="form-group required py-2">
								<label>Post Title*</label>   
								<input type="text" id="Title" class="form-control rounded" placeholder="Insert Post Title Here" > 
							</div>

							<div class="form-group required py-2">
								<label>Video*</label>   
								<input type="text" id="Content" class="form-control" placeholder="Insert YouTube link here" >
								
							</div>

                            <div class="form-group required py-3">
								<label>Video Description*</label>   
								<textarea id="Description" class="form-control" rows="6" placeholder="Insert Video description here" ></textarea>
								
							</div>

							<div class="form-group py-2 float-end">
								<button type="button" id="BtnPost" class="btn btn-primary btn-block">Post</button>
								
							</div>
						</div>
				</div>        
            </div>
			</div>
                    <?php include("navbarfoot.php");?>

<!-- navbar ends here -->

            <script language="javascript">
		
        $("#BtnPost").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var title = $("#Title").val();
                var content = $("#Content").val();
                var description  = $("#Description").val();

                content = youtube_parser(content)

            

                if (title == null || title == "") {
                    alert(alertNotice);
                    $("#Title").focus();
                }
                
                else if (content == null || content == "") {
                    alert(alertNotice);
                    $("#Content").focus();
                }

                else {
                    
                    $.post("process.vlog.php", {
                        title: title,
                        content: content, 
                        description: description 
                    }, function(data,status) {
						if(status == "success"){
                        alert("Posted Successfully");
                        window.location = "vlog.php";
						}
                    })
                }
            });


    </script>

<script type="text/javascript">
function youtube_parser(url){
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#&?]*).*/;
    var match = url.match(regExp);
    return (match&&match[7].length==11)? match[7] : false;
}
</script>