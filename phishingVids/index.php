

<html>

<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="../styles/styles.css" />

<link rel="stylesheet" href="style.css">


    <head>
    <?php 
session_start();
if(empty($_SESSION["accID"])){
    include("../navbarHeadPH.php");
} else{
        if(!empty($_SESSION["companyID"])){
                
        include("../navbarCompanyPH.php");

        }
        else{
                include("../navbarLoggedPH.php");

        }
}

        ?>
        <title>Phishing Videos</title>
    </head> 

    <body><div class="container col-8">
            <h3 style="color: white;">Phishing Videos</h3>
        
            
                <div class="small-img-row">
                        <iframe width="300" height="150"
                        src="https://www.youtube.com/embed/nXoXo6H93WQ">
                    </iframe>
                    <p> English Video</p>
                </div>
                <div class="small-img-row">
                        <iframe width="300" height="150"
                        src="https://www.youtube.com/embed/5oUR9PJdnVM">
                    </iframe>
                    <p>Hiligaynon</p>
                </div>
                <div class="small-img-row">
                        <iframe width="300" height="150"
                            src="https://www.youtube.com/embed/tfkpW4dJl20">
                        </iframe>
                    <p>Tagalog Video</p>
                </div>
            </div>
       

            <?php include("../navbarfoot.php");?>
        


<script>
    var videoPlayer = document.getElementById("videoPlayer");
    var Videos = document.getElementById("Videos");

    function stopVideo(){
        videoPlayer.style.display = "none";
    }

    function playVideo(file){
        Videos.src = file;
        videoPlayer.style.display ="block";
    }

</script>
        

</html>