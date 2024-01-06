<?php 
include("header.php");

session_start();
include("connCheck.php");


include("requireLogin.php");

?>


<!-- navbar starts here -->
<?php
include("navbarLogged.php"); ?>      
        
            <!-- Chat starts Here-->
            <button type="button" id="clearBtn">Refresh</button>

            
                <div class="card overflow-auto" style="max-height: 500px" id="chat_container">     
                <?php include("chatloop.php");?>
                </div>

                <div class="container-fluid py-2">
                    
                    <div class="container mx-2">
                        <textarea id="messageContent" class="my-2 form-control" placeholder="type your message here"></textarea>
                        <button type="button" id="chatBtn" class="btn btn-warning float-end">Chat</button>
                    </div>
                    </select>
                </div>
                
                
                        
                        
            <!-- Chat ends Here-->
            <?php
include("navbarfoot.php"); ?>   

<!-- navbar ends here -->

           

            <?php
            include("footer.php");
            ?>


            <script>

                var conn = new WebSocket('ws://localhost:8080?friendID=<?php echo $_GET['friendID'] ?>');
                $(document).ready(function () {
                        conn.onopen = function(e) {
                            console.log("Connection established!");
                        };

                        conn.onmessage = function(e) {
                        console.log(e.data);

                        var data = JSON.parse(e.data);
                        
                        div = document.getElementById("chat_container");
                        chat = document.createElement("div");
                        chat.className = "card col-md-12 px-auto my-1 overflow-auto";

                        if (data.receiveID == <?php echo $_SESSION['accID'] ?>) {
                            let idTxt = '#'.concat('chat_container'); 

                        let html_data = `
                                <?php $sql_chat = "
                                SELECT username FROM tblusers
                                WHERE accID = ". $_REQUEST["friendID"];

                                ?>         
                            
                        <?php $qry_chat = mysqli_query($conn, $sql_chat); ?>
                        <?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
                                    <div class="card-header">
                                        <h5 class="card-title">to: <?php echo $_SESSION['username']; $_SESSION['receivename'] = $get_chat["username"]; ?></h5>
                                        
                                        <div style="height: 100px;"class="card-body">
                                            <p>${data.message}</p>
                                            
                                        </div>
                                    </div>
                                    <div class="card-footer">from: <?php
                                    echo $get_chat["username"] ?> </div>
                                    <?php }?>`;
                                chat.innerHTML = html_data;
                                div.appendChild(chat); 
                        };
                            
                        }

                        

                });
                
                alertNotice ="Please enter a message";

                document.getElementById("clearBtn").addEventListener("click", clearDivRefresh, false);

                //give session ID
                <?php 
                $phpaccID = $_SESSION['accID'];
                echo 'accID = '.$phpaccID;
                ?>;

                function clearDivRefresh(){                    
                div = document.getElementById("chat_container");
                div.replaceChildren();                                     
                window.location = `chat.php?friendID=${receiveID}`;
                }

                document.getElementById("chatBtn").addEventListener("click", chat, false);

                function chat() {
                    chatParam = document.getElementById("messageContent").value;
                    message = chatParam;
                    receiveID = <?php echo $_GET['friendID'].";";?>
                    if (message == null || message == "") {
                    alert(alertNotice);
                    $(chatBox).focus();
                }

                    else{
                        $.post("process.chat.php", {
                            message: message,
                            receiveID: receiveID,
                            accID: accID
                    }, function(data,status) {
                            if(status == "success"){
                                alert("Chatted Successfully"); 
                                div = document.getElementById("chat_container");
                                chat = document.createElement("div");
                                chat.className = "card col-md-12 px-auto my-1 overflow-auto";
                                let html_data = `
                                <?php $sql_chat = "
                                SELECT username FROM tblusers
                                WHERE accID = ". $_REQUEST["friendID"];

                                ?>    

        
                            
        <?php $qry_chat = mysqli_query($conn, $sql_chat); ?>
		<?php while($get_chat = mysqli_fetch_array($qry_chat)){ ?>
                                    <div class="card-header">
                                        <h5 class="card-title">to: <?php echo $get_chat["username"]; $_SESSION['receivename'] = $get_chat["username"]; ?></h5>
                                        
                                        <div style="height: 100px;"class="card-body">
                                            <p>${message}</p>
                                            
                                        </div>
                                    </div>
                                    <div class="card-footer">from: <?php
                                    echo $_SESSION['username'] ?> </div>
                                    <?php }?>`; 
                                chat.innerHTML = html_data;
                                div.appendChild(chat); 
                                username = `<?php echo $_SESSION["username"] ?>`;
                                receivename = `<?php echo $_SESSION['receivename'] ?>`; 
                                
                                var chatMsg = {
                                    message: message,
                                    receivename: receivename,
                                    receiveID: receiveID,
                                    username: username,
                                    command: 'Private'        
                                }

                                conn.send(JSON.stringify(chatMsg));
                            }
                        })
                        
                    } 
                }

            </script>