<html>
    <head>
        <title>Superphishal</title>
        <link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="../styles/styles.css" />
    <script language="javascript" src="../bootstrap/js/bootstrap.js"></script>
    <script language="javascript" src="../js/jquery.js"></script>
    </head>
    <body>
    <div class="container-fluid d-flex justify-content-center">
    <div class="col-sm-12 mt-3 d-flex justify-content-center">
                <div class="card">
                        <div class="card-header mx-6">
                            ADMIN Login

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                 <label>E-mail Address</label>   
                                <input value="admin" type="text" id="Username" class="form-control rounded" placeholder="E-mail" > 
                            </div>

                            <div class="form-group ">
                                <label>Password</label>   
                                <input value="pass" type="Password" id="Password" class="form-control rounded" placeholder="Password" > 
                                
                            </div>

                            <div class="form-group py-2">
                                <button type="button" id="BtnLogin" class="btn btn-primary btn-block">Login</button>
                                
                            </div>
                        </div>
                </div>        



    </div>
</div>
        
    <script language="javascript">
        $("#BtnLogin").on("click", function() {
                
            var alertNotice = "Fields marked with * are required.";
            

                var username = $("#Username").val();
                var password = $("#Password").val();

                if (username == null || username == "") {
                    alert(alertNotice);
                    $("#Username").focus();
                }
                
                else if (password == null || password == "") {
                    alert(alertNotice);
                    $("#Password").focus();
                }

                else {
                    
                    $.post("process.login.php", {
                        uname: username,
                        pword: password
                    }, function(data,status) {                        
						if(status == "success"){
                        window.location = "dashboard.php";
						}
                    })
                }
            });


    </script>


    </body>

</html>

