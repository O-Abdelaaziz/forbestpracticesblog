<?php $currentPage="single poste"?>
<?php require_once ("./includes/header.php")?>
        <div id="layoutDefault">
            <div id="layoutDefault_content">
                <main>
                    
                    <nav class="navbar navbar-marketing navbar-expand-lg bg-white navbar-light">
                        <div class="container">
                            <a class="navbar-brand text-dark" href="index.php">TechBarik</a><button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><img src="img/menu.png" style="height:20px;width:25px" /><i data-feather="menu"></i></button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav ml-auto mr-lg-5">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home </a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>
                                    <li class="nav-item dropdown no-caret">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                </ul>
                                <?php
                                $currentPage=basename(__FILE__).'?post_id='.$_GET['post_id'];
                                require_once('./includes/registration.php') ?>
                            </div>
                        </div>
                    </nav>
                    <?php
                    if(isset($_GET['post_id'])) {
                        $postId = $_GET['post_id'];
                        $sqlSinglePost = "select * from posts where id= :id";
                        $statement = $pdo->prepare($sqlSinglePost);
                        $statement->execute([
                            ':id' => $postId
                        ]);
                        $singlePost = $statement->fetch(PDO::FETCH_ASSOC);

                        $count = $statement->rowCount();
                        if ($count == 0) {
                            header("Location: index.php");
                        }
                        $postTitle = $singlePost['title'];
                        $postDescription = $singlePost['description'];
                        $postAuthor = $singlePost['author'];
                        $postCategory = $singlePost['categoryId'];
                        $singlePosttatus = $singlePost['status'];
                        $postDate = $singlePost['date'];
                        $postImage = $singlePost['image'];
                        $postCommentCount = $singlePost['comment_count'];
                        $postViewes = $singlePost['viewes'];
                        $postLikes = $singlePost['likes'];
                        $postTags = $singlePost['tags'];

                        $sqlUpdatePostView="update posts set viewes= :viewes  where id= :id";
                        $updateStatment=$pdo->prepare($sqlUpdatePostView);

                        $updateStatment->execute([
                                 ':viewes'=>++$postViewes,
                                 ':id'=>$postId
                        ]);


                        $sqlSingleCategory="select * from categories where id=:id";
                        $singleCategoryStatement=$pdo->prepare($sqlSingleCategory);
                        $singleCategoryStatement->execute([
                                ":id"=>$postCategory
                        ]);
                        $getCatiegories=$singleCategoryStatement->fetch(PDO::FETCH_ASSOC);
                        $catNam=$getCatiegories['name'];
                    }else{
                        header("Location: index.php");
                    }
                        ?>

                    <header class="page-header page-header-dark bg-gradient-primary-to-secondary">
                        <div class="page-header-content pt-10">
                            <div class="container text-center">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8">
                                        <h1 class="page-header-title mb-3"><?php echo $postTitle ?></h1>
                                        <p class="page-header-text">Category: <?php echo $catNam ?>,Posted by: <?php echo $postAuthor; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-rounded text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                    </header>
                    <section class="bg-white py-10">
                        <div class="container">
                            <!--start post content-->
                            <div>
                                <h1><?php echo $postTitle ?>.</h1>
                                <p class="lead"><?php echo $postDescription ?></p>
                            </div>
                            <!--end post content-->

                            <!--start comment section-->
                            <div class="pt-5 col-lg-8 col-xl-9">
                                <div class="d-flex align-items-center justify-content-between flex-column flex-md-row">
                                    <h2 class="mb-0">Comments</h2>
                                </div>
                                <hr class="mb-4" />
                                <div class="card mb-5">
                                    <div class="card-header d-flex justify-content-between">
                                        <div class="mr-2 text-dark">
                                            John Doe
                                            <div class="text-xs text-muted">November 19, 2020 at 11:31 PM</div>
                                        </div>
                                        <div class="h5"><span class="badge badge-warning-soft text-warning font-weight-normal">Awaiting Response</span></div>
                                    </div>
                                    <div class="card-body">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque blanditiis, exercitationem architecto accusamus quis repellendus magni nam ipsam id qui non itaque eos, consectetur maiores aperiam sapiente. Libero, possimus minus.                                  
                                    </div>
                                </div>

                                <?php
                                    if(isset($_SESSION['login'])){?>

                                        <div class="card">
                                            <div class="card-header">Add Comment</div>
                                            <div class="card-body">
                                                <textarea placeholder="Type here..." class="form-control mb-2" rows="4"></textarea>
                                                <button class="btn btn-primary btn-sm mr-2">Post Comment</button>
                                            </div>
                                        </div>

                                    <?php }else{
                                        echo "<a href='backend/signin.php'>sigin in to post a comment</a>";
                                    }


                                    ?>

                            </div>
                            <!--end comment section end-->
                        </div>

                        <!--Rounded style-->
                        <div class="svg-border-rounded text-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144.54 17.34" preserveAspectRatio="none" fill="currentColor"><path d="M144.54,17.34H0V0H144.54ZM0,0S32.36,17.34,72.27,17.34,144.54,0,144.54,0" /></svg>
                        </div>
                        <!--Rounded style-->
                    </section>
                </main>
            </div>

            <!--Footer start-->
            <div id="layoutDefault_footer">
                <footer class="footer pt-4 pb-4 mt-auto bg-dark footer-dark">
                    <div class="container">
                        <hr class="my-1" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &#xA9; Your Website 2020</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#">Privacy Policy</a>
                                &#xB7;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!--Footer end-->
<?php require_once("./includes/footer.php") ?>