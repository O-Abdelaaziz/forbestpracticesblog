<?php
require_once("../includes/database.php")
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Recover Your Password || Admin Panel</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="js/all.min.js"></script>
        <script src="js/feather.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Password Recovery</h3></div>
                                    <div class="card-body">
                                        <div class="small mb-3 text-muted">Enter your email address and we will send you a link to reset your password.</div>
                                        <?php
                                        if(isset($_POST['reset'])){
                                            $getEmail=$_POST['email'];
                                            $sql="select * from users where email=:email";
                                            $statament=$pdo->prepare($sql);
                                            $statament->execute([
                                                    ":email"=>$getEmail
                                            ]);
                                            $checkUser=$statament->rowCount();

                                            if($checkUser==1){
                                                $show="new password";
                                            }else{
                                                echo "<p class='alert alert-danger'> wrong email or nickname not found</p>";
                                            }
                                        }
                                        ?>
                                        <?php

                                        if(isset($show)){?>

                                            <form action="forgot-password.php" method="post">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Password</label>
                                                    <input name="password" class="form-control py-4" id="inputEmailAddress" type="password" aria-describedby="emailHelp" placeholder="Enter email address" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Confirm password</label>
                                                    <input name="confirmpassword" class="form-control py-4" id="inputEmailAddress" type="password" aria-describedby="emailHelp" placeholder="Enter email address" />
                                                </div>
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <a class="small" href="signin.php">Return to login</a>
                                                    <button name="reset" class="btn btn-primary">Reset Password</button>
                                                </div>
                                            </form>

                                       <?php }else{?>
                                            <form action="forgot-password.php" method="post">
                                                <div class="form-group">
                                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                    <input name="email" class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                                </div>
                                                <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                    <a class="small" href="signin.php">Return to login</a>
                                                    <button name="reset" class="btn btn-primary">Reset Password</button>
                                                </div>
                                            </form>
                                        <?php } ?>

                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="signup.php">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!--Script JS-->
        <script src="js/jquery-3.4.1.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
