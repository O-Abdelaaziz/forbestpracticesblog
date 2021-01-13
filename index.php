<?php $currentPage="index"?>
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
                                <a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signin.php">Sign in<i class="fas fa-arrow-right ml-1"></i></a>
                                <a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signup.php">Sign up<i class="fas fa-arrow-right ml-1"></i></a>
                            </div>
                        </div>
                    </nav>

                    <header class="page-header page-header-dark bg-secondary">
                        <div class="page-header-content">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-xl-8 col-lg-10 text-center">

                                        <h1 class="page-header-title">Welcome to TechBarik</h1>
                                        <p class="page-header-text mb-5">Are you searching for some content that you haven't found yet? Try searching in the search box below!</p>
                                        <form class="page-header-signup mb-2 mb-md-0">
                                            <div class="form-row justify-content-center">
                                                <div class="col-lg-6 col-md-8">
                                                    <div class="form-group mr-0 mr-lg-2"><input class="form-control form-control-solid rounded-pill" type="text" placeholder="Search keyword..."/></div>
                                                </div>
                                                <div class="col-lg-3 col-md-4"><button class="btn btn-teal btn-block btn-marketing rounded-pill" type="submit">Search</button></div>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="svg-border-waves text-white">
                            <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                                <defs>
                                    <style>
                                        .a {
                                            fill: none;
                                        }
                                        .b {
                                            clip-path: url(#a);
                                        }
                                        .d {
                                            opacity: 0.5;
                                            isolation: isolate;
                                        }
                                    </style>
                                    <clipPath id="a"><rect class="a" width="1920" height="75" /></clipPath>
                                </defs>
                                <title>wave</title>
                                <g class="b"><path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48" /></g>
                                <g class="b"><path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10" /></g>
                                <g class="b"><path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24" /></g>
                                <g class="b"><path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150" /></g>
                            </svg>
                        </div>
                    </header>
                    <section class="bg-white py-10">
                        <!--Start-->
                        <div class="container">
                        <h1>Most popular post:</h1>
                        <hr />
                            <?php
                            $sqlMostPopularPost='SELECT * FROM posts order by viewes DESC limit 0,1';
                            $statementsqlMostPopularPost=$pdo->prepare($sqlMostPopularPost);
                            $statementsqlMostPopularPost->execute();
                            $mostPopularPost = $statementsqlMostPopularPost->fetch(PDO::FETCH_ASSOC);
                            $mostPopularPostId=$mostPopularPost['id'];
                            $mostPopularPostTitle=$mostPopularPost['title'];
                            $mostPopularPostDescription=substr($mostPopularPost['description'],0,140) ;
                            $mostPopularPostAuthor=$mostPopularPost['author'];
                            $mostPopularPostDate=$mostPopularPost['date'];
                            ?>
                            <a class="card post-preview post-preview-featured lift mb-5" href="single.php?post_id=<?php echo $mostPopularPostId ?>">
                                <div class="row no-gutters">
                                    <div class="col-lg-5"><div class="post-preview-featured-img" style='background-image: url("./img/pic1.png")'></div></div>
                                    <div class="col-lg-7">
                                        <div class="card-body">
                                            <div class="py-5">
                                                <h5 class="card-title"><?php echo $mostPopularPostTitle ?></h5>
                                                <p class="card-text">
                                                    <?php echo $mostPopularPostDescription ?>
                                                </p>
                                            </div>
                                            <hr />
                                            <div class="post-preview-meta">
                                                <img class="post-preview-meta-img" src="./img/mdabarik.jpg" />
                                                <div class="post-preview-meta-details">
                                                    <div class="post-preview-meta-details-name"><?php echo $mostPopularPostAuthor ?></div>
                                                    <div class="post-preview-meta-details-date"><?php echo $mostPopularPostDate ?></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h1>Recent posting:</h1>
                            <hr />
                            <div class="row">

                                <?php
                                $sql="select * from posts where status = :status";
                                $statement=$pdo->prepare($sql);
                                $statement->execute([
                                        ':status'=>'Published'
                                ]);
                                //$posts=$statement->fetch(PDO::FETCH_ASSOC);

                                while ($posts=$statement->fetch(PDO::FETCH_ASSOC)){
                                    $postId=$posts['id'];
                                    $postTitle=$posts['title'];
                                    $postDescription=substr($posts['description'],0,140) ;
                                    $postAuthor=$posts['author'];
                                    $postCategory=$posts['category'];
                                    $postStatus=$posts['status'];
                                    $postDate=$posts['date'];
                                    $postImage=$posts['image'];
                                    $postCommentCount=$posts['comment_count'];
                                    $postViewes=$posts['viewes'];
                                    $postLikes=$posts['likes'];
                                    $postTags=$posts['tags'];?>

                                    <div class="col-md-6 col-xl-4 mb-5">
                                        <a class="card post-preview lift h-100" href="single.php?post_id=<?php echo $postId ?>"
                                        ><img class="card-img-top" src="./img/<?php echo $postImage ?>" alt="<?php echo $postImage ?>" />
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $postTitle ?></h5>
                                                <p class="card-text">
                                                    <?php echo $postDescription ?>
                                                </p>
                                            </div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <div class="post-preview-meta">
                                                    <img class="post-preview-meta-img" src="./img/legend.png" />
                                                    <div class="post-preview-meta-details">
                                                        <div class="post-preview-meta-details-name"><?php echo $postAuthor ?></div>
                                                        <div class="post-preview-meta-details-date">Posted on: <?php echo $postDate ?></div>
                                                    </div>
                                                </div>
                                                <div class="div.post-preview-meta">
                                                    <i class="fas fa-eye"></i>
                                                    <?php echo $postViewes ?>
                                                </div>
                                            </div>
                                        </a>
                                    </div>

                                <?php }
                                ?>

                            </div>

                            <nav aria-label="Page navigation example">
                                <ul class="pagination pagination-blog justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#!" aria-label="Previous"><span aria-hidden="true">&#xAB;</span></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#!">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#!">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#!">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#!">12</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#!" aria-label="Next"><span aria-hidden="true">&#xBB;</span></a>
                                    </li>
                                </ul>
                            </nav>


                            <h1 class="pt-5">Most viewed posts:</h1>
                            <hr />
                            <div class="row">
                                <?php
                                $sqlMostViewedPosts="SELECT * FROM posts ORDER BY viewes DESC LIMIT 0,3";
                                $statementMostViewedPosts=$pdo->prepare($sqlMostViewedPosts);
                                $statementMostViewedPosts->execute();
                                while ($mostViewedPosts=$statementMostViewedPosts->fetch(PDO::FETCH_ASSOC)){
                                    $mostViewedPostsTitle=$mostViewedPosts['title'];?>

                                <div class="col-md-6 col-xl-4 mb-5">
                                    <a class="card post-preview lift h-100" href="#!"
                                        ><img class="card-img-top" src="./img/pic1.png" alt="photo" />
                                        <div class="card-body">
                                            <h5 class="card-title"><?php echo $mostViewedPostsTitle ?></h5>
                                            <p class="card-text">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                            </p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="post-preview-meta">
                                                <img class="post-preview-meta-img" src="./img/mdabarik.jpg" />
                                                <div class="post-preview-meta-details">
                                                    <div class="post-preview-meta-details-name">Aariz Fischer</div>
                                                    <div class="post-preview-meta-details-date">Feb 4 &#xB7; 5 min read</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php }
                                ?>
                            </div>

                            <h1 class="pt-5">Browse by categories:</h1>
                            <hr />

                            <div class="row features text-center mb-5">
                                <?php
                                $sqlCategory="select * from categories where status= :status";
                                $statement=$pdo->prepare($sqlCategory);
                                $statement->execute([':status'=>'Published']);

                                while ($Categories=$statement->fetch(PDO::FETCH_ASSOC)){
                                $id=$Categories["id"];
                                $name=$Categories["name"];
                                $total_posts=$Categories["total_posts"];
                                $post_views=$Categories["post_views"];
                                $status=$Categories["status"];
                                $created_on=$Categories["created_on"];
                                $created_by=$Categories["created_by"];?>

                                <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
                                    <a class="card card-link border-top border-top-lg border-teal h-100 lift" href="#!"
                                        ><div class="card-body p-5">
                                            <div class="icon-stack icon-stack-lg bg-teal-soft text-teal mb-4"><i data-feather="clock"></i></div>
                                            <h6><?php echo $name?></h6>
                                        </div>
                                        <div class="card-footer bg-transparent pt-0 pb-5"><div class="badge badge-pill badge-light font-weight-normal px-3 py-2"><?php echo $total_posts?> Posts</div></div>
                                    </a>
                                </div>
                                <?php  }?>

                            </div>
                        </div>
                        <!--End-->   
                        <!--Waves-->
                        <div class="svg-border-waves text-dark">
                            <svg class="wave" style="pointer-events: none" fill="currentColor" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1920 75">
                                <defs>
                                    <style>
                                        .a {
                                            fill: none;
                                        }
                                        .b {
                                            clip-path: url(#a);
                                        }
                                        .d {
                                            opacity: 0.5;
                                            isolation: isolate;
                                        }
                                    </style>
                                    <clipPath id="a"><rect class="a" width="1920" height="75" /></clipPath>
                                </defs>
                                <title>wave</title>
                                <g class="b"><path class="c" d="M1963,327H-105V65A2647.49,2647.49,0,0,1,431,19c217.7,3.5,239.6,30.8,470,36,297.3,6.7,367.5-36.2,642-28a2511.41,2511.41,0,0,1,420,48" /></g>
                                <g class="b"><path class="d" d="M-127,404H1963V44c-140.1-28-343.3-46.7-566,22-75.5,23.3-118.5,45.9-162,64-48.6,20.2-404.7,128-784,0C355.2,97.7,341.6,78.3,235,50,86.6,10.6-41.8,6.9-127,10" /></g>
                                <g class="b"><path class="d" d="M1979,462-155,446V106C251.8,20.2,576.6,15.9,805,30c167.4,10.3,322.3,32.9,680,56,207,13.4,378,20.3,494,24" /></g>
                                <g class="b"><path class="d" d="M1998,484H-243V100c445.8,26.8,794.2-4.1,1035-39,141-20.4,231.1-40.1,378-45,349.6-11.6,636.7,73.8,828,150" /></g>
                            </svg>
                        </div>  
                        <!--End Waves-->            

                </main>
            </div>

            <div id="layoutDefault_footer">
                <footer class="footer pt-2 pb-4 mt-auto bg-dark footer-dark">
                    <div class="container">
                        <hr class="mb-1" />
                        <div class="row align-items-center">
                            <div class="col-md-6 small">Copyright &#xA9; TechBarik 2020</div>
                            <div class="col-md-6 text-md-right small">
                                <a href="#">Privacy Policy</a>
                                &#xB7;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
<?php require_once("./includes/footer.php") ?>