<?php

if(!file_exists("connect.php")){
    echo "unable to locate <strong>connect.php</strong>";
    exit();
}
include("connect.php");

$sql_update = "UPDATE tblusers
                SET status = 'enabled'
                WHERE
            verificationCode = ?";

            if ($statement = mysqli_prepare($conn, $sql_update)) {
                mysqli_stmt_bind_param($statement, "s",
                    $verficationCode);

                $verficationCode = $_GET['vcode'];

        
				
				mysqli_stmt_execute($statement);
                echo "Verified Successfully";
                header( "refresh:12; url=companies.php?status=verified" ); 
            }?>

            
<p id="demo"></p>

<script>
// Set the date we're counting down to
var countDownDate = new Date();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date();
  now = now.setSeconds(now.getSeconds() - 12)
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("demo").innerHTML = "Redirecting in "+ seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "REDIRECTING";
  }
}, 1000);
</script>