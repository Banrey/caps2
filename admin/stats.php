<?php

include("admin.header.php");
if(!file_exists("../connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("../connect.php");

$txt_id = "";
$txt_title = "";
$txt_content = "";
$txt_image = "";
if (@$_GET["action"] == "update"){
	$sql_cat = "SELECT  statID, title, content, image FROM stats WHERE statID = ?";

    if ($cat_check = mysqli_prepare($conn, $sql_cat)){
        mysqli_stmt_bind_param($cat_check, "i", $id,);
        
        $id = $_GET['statID'];

        mysqli_stmt_execute($cat_check);
        
        mysqli_stmt_bind_result($cat_check, $ID, $title, $content, $image);
        while(mysqli_stmt_fetch($cat_check)){
			
           $txt_id = $ID;
		   $txt_title = $title;
		   $txt_content = $content;
		   $txt_image = $image;
            
        }
    }

}
?>




<div class="container border">
    <div class="row overflow-auto p-2" style="max-height: 500px;">
        <div class="col-sm-12 ">
			<div class="row">
				<h3>Statistics</h3>
				
				<iframe name="empty" style="display:none;"></iframe>
        <form method="POST" action="process.stats.php" enctype="multipart/form-data" id="update">
				<div class="col-sm-5 ">
					<div class="form-group">
										<label>Title</label>   
										<input value="<?php echo $txt_title; ?>" name="title" type="text" id="title" class="form-control rounded" placeholder="Title" required > 
									
					</div>
            	</div>

				<div class="col-sm-5 ">
					<div class="form-group">
											<label>Content</label>   
											<input value="<?php echo $txt_content; ?>" name="content" type="text" id="content" class="form-control rounded" placeholder="Content" required> 
										
					</div>
				</div>	

                
				<div class="col-sm-5">
					<div class="form-group">
                        
                    <label>Image</label>  
                        <div class="card"> 
                            <?php if (empty($txt_image)) {?>
                            <input type="file" id="uploadfile" name="uploadfile" required>
                            
							</div>
                           <?php } else {?>

						    <img class="card-img-top" src=<?php echo "../images/".$txt_image; ?> alt="..." width="300" height="200">
							</div>
                            <label for="myfile">Update Statistic Image:</label>
							<input type="file" id="uploadfile" name="uploadfile" required>
                           <?php }?>

                        
											
										
					</div>
				</div>	
				
				<div class="col-sm-2 float-end">
					<div class="form-group">
						<input type="hidden" name="statID" value="<?php echo $txt_id; ?>" id="id" >
						<input type="button" id="BtnPost" class="btn btn-warning btn-block my-3" value="Save Statistic">
										
					</div>

			</form>
            	</div>
			</div>
        </div>
    </div>
        <div class="row p-2">
            <div class="col-sm-12 ">
				<table border="1" class="table table-striped">
					<thead>
						<tr> 
							<td width= "15%">Action</td>
							<td width= "12%">Post ID</td>
							<td width= "12%">Account ID</td>
							<td width= "20%">Title</td>
							<td width= "20%">Content</td>
						</tr>
					</thead>
					<tbody>
						<?php $ctr = 0; ?>
						<?php $sql_post = "
						SELECT 
							statID, image, title, content
						FROM stats
							" ?>
						<?php $qry_post = mysqli_query($conn, $sql_post); ?>
						<?php while($get_post = mysqli_fetch_array($qry_post)){ ?>
						<?php $ctr++; ?>
						<tr class="overflow-auto">
							<td> <a href="stats.php?action=update&statID=<?php echo $get_post["statID"] ?>"> 
							Update</a> /
							<a href="process.stats.php?action=delete&statID=<?php echo $get_post["statID"] ?>">
							Delete</a>
							</td>
							<td><?php echo $get_post["statID"] ?></td>
							<td><img src="../images/<?php echo $get_post["image"]; ?>" height = "200"></td>
							<td><?php echo $get_post["title"] ?></td>
							<td><?php echo $get_post["content"] ?></td>
						</tr>
						<?php } ?>
					</tbody>
					<tfoot>
						<tr>
							<td colspan = "3">Total Posts :<?php echo $ctr; ?></td>
						</tr>
					</tfoot>
				</table>
            </div>            
        </div>
</div>



<script language="javascript">

	alertNotice = "All fields are required"
	$(document).ready(function () {
				

$( "#BtnPost" ).on( "click", function( event ) {
  event.preventDefault();

  
  var title = $("#title").val();
                var content = $("#content").val();
                var image = $("#uploadfile").val();
				

                

				if (image == null || image == "") {
                    alert(alertNotice);
                    $("#uploadfile").focus();
                }
				else if (title == null || title == "") {
                    alert(alertNotice);
                    $("#title").focus();
                }
				else if (content == null || content == "") {
                    alert(alertNotice);
                    $("#content").focus();
                }
				else{
					
				$('form#update').submit();

				}



  
});
				

});

    </script>

<?php
include("admin.footer.php");
