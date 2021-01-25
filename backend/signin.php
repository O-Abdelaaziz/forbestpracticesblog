<?php session_start(); ?>
<?php require_once("../includes/database.php") ?>

<?php
    if(isset($_SESSION['login']) || isset($_COOKIE['_uid_']) || isset($_COOKIE['_unickname_'])){
        header("Location: ../index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>SIGN IN || Admin Panel</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.png" />
        <script data-search-pseudo-elements defer src="js/all.min.js"></script>
        <script src="js/feather.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <?php
                    if(isset($_POST['submit'])){
                        $email=trim($_POST['email']);
                        $password=trim($_POST['password']);
                        $sql="select * from users where email=:email";
                        $statment=$pdo->prepare($sql);
                        $statment->execute([
                                ':email'=>$email,
                        ]);
                       $counUser=$statment->rowCount();
                       if($counUser==0){
                           $error= "wrong cridencial";
                       }else if($counUser>1){
                           $error= "wrong cridencial";
                       }else{
                           $user=$statment->fetch(PDO::FETCH_ASSOC);
                           $passwordhached=$user['password'];
                           $nickName=$user['nickname'];
                           $userRole=$user['role'];

                           if(password_verify($password,$passwordhached)){
                               $success="welcome ".$email."";
                               if(!empty($_POST['check'])){

                                   echo "check is cheked";

                                   $userId=$user['id'];
                                   $userNickName=$user['nickname'];
                                   $encodUserId=base64_encode($userId);
                                   $encodUserNickName=base64_encode($userNickName);

                                   echo "check is codede".'<br>'.$encodUserId.'<br> '.$encodUserNickName;

                                   //set cookies for one day
                                   setcookie('_uid_',$encodUserId,time() + 60 * 60 * 24,'/','','',true);
                                   setcookie('_unickname_',$encodUserNickName,time() + 60 * 60 * 24,'/','','',true);

                                   echo "check is coockies set";
                               }
                               $_SESSION['nickname']=$nickName;
                               $_SESSION['role']=$userRole;
                               $_SESSION['login']='success';

                               echo "check is session set";


                               header("Refresh:2;url=../index.php");
                           }else{
                               $errorWrongPassword="password error";
                           }

                       }
                    }
                    ?>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">SIGN IN</h3></div>
                                    <div class="card-body">
                                        <form method="post" action="signin.php">
                                            <?php
                                            if(isset($error)){
                                                echo "<p class='alert alert-danger'>{$error}</p>";
                                            }else if (isset($errorWrongPassword)){
                                                echo "<p class='alert alert-danger'>{$errorWrongPassword}</p>";
                                            }else if(isset($success)){
                                                echo "<p class='alert alert-success'>{$success}</p>";
                                            }
                                            ?>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                                <input name="email" class="form-control py-4" id="inputEmailAddress" type="email" placeholder="Enter email address" />
                                            </div>
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" />
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox">
                                                    <input name="check" class="custom-control-input" id="rememberPasswordCheck" type="checkbox" />
                                                    <label class="custom-control-label" for="rememberPasswordCheck">Remember password</label>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
<!--                                                <a class="small" href="#"></a><a class="btn btn-primary btn-block" href="index.php">SIGN IN</a>-->
                                                <button name="submit" class="btn btn-primary btn-block" type="submit">SIGN IN</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">
                                            <a href="signup.php">Need an account? Sign up!</a>&nbsp;
                                            <a href="forgot-password.php">Forget password</a>
                                        </div>
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
