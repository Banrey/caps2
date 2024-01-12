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
				<h3>Posts</h3>
				<div class="col-sm-5 ">
					<div class="form-group">
										<label>Title</label>   
										<input value="<?php echo $txt_title; ?>" type="text" id="title" class="form-control rounded" placeholder="Title" > 
									
					</div>
            	</div>

				<div class="col-sm-5 ">
					<div class="form-group">
											<label>Content</label>   
											<input value="<?php echo $txt_content; ?>" type="text" id="content" class="form-control rounded" placeholder="Content" > 
										
					</div>
				</div>	

                
				<div class="col-sm-5">
					<div class="form-group">
                        
                    <label>Image</label>  
                        <div class="card"> 
                            <?php if (empty($txt_image)) {?>
                            <form >
                            <input type="file" id="myFile" name="filename">
                            <input type="submit">
                            </form>
                           <?php } else {?>

						    <img class="card-img-top" src="..." alt="..." width="300" height="200">
                           <?php }?>

                        </div>
											
										
					</div>
				</div>	
				
				<div class="col-sm-2 float-end">
					<div class="form-group">
						<input type="hidden" value="<?php echo $txt_id; ?>" id="id" >
						<button type="button" id="BtnPost" class="btn btn-warning btn-block my-3">Save Statistic</button>
										
					</div>
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
							*
						FROM stats
							" ?>
						<?php $qry_post = mysqli_query($conn, $sql_post); ?>
						<?php while($get_post = mysqli_fetch_array($qry_post)){ ?>
						<?php $ctr++; ?>
						<tr class="overflow-auto">
							<td> <a href="stats.php?action=update&statID=<?php echo $get_post["postID"] ?>"> 
							Update</a> /
							<a href="process.stats.php?action=delete&statID=<?php echo $get_post["postID"] ?>">
							Delete</a>
							</td>
							<td><?php echo $get_post["postID"] ?></td>
							<td><?php echo $get_post["accID"] ?></td>
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
        $("#BtnPost").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var txtTitle = $("#title").val();
                var $txt_content = $("#content").val();
                var txtID = $("#id").val();
				

                if (txtTitle == null || txtTitle == "") {
                    alert(alertNotice);
                    $("#category").focus();
                }
                

                else {
                    
                    $.post("process.stats.php", {
                        title: txtTitle,
                        content: $txt_content,
                        postID: txtID
                    }, function(data,status) {
                        
						if(status == "success"){
                        window.location = "stats.php";
						}
                    })
                }
            });


    </script>

<?php
include("admin.footer.php");
