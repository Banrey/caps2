<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 bg-warning">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-dark min-vh-100">
                <a class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline"><?php 
                                                                if (empty($_SESSION['session_id'])) {
                                                                    echo 'no session id';

                                                                }
                                                                else{?>
                                                                <p id="accID"> 
                                                                    <?php 
                                                                        if(empty($_SESSION['session_id'])){
                                                                            echo 'Logged in as Guest';
                                                                        } else {
                                                                            echo 'Logged in as '.$_SESSION['username'];
                                                                        } ?>
                                                                </p>
                                                                    <?php
                                                                }?></span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="phishingVids" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Videos</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="phishingSim" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Phishing Simulator</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="vlog.php" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Vlogs</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="forum.php" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Forum</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="friendslist.php" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Friends</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="myPosts.php" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">My Posts</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="process.logout.php" class="nav-link link-dark align-middle px-0">
                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-10 py-3"> 