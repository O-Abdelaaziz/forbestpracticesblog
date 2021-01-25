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
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>SIGN UP || Admin Panel</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.png"/>
    <script data-search-pseudo-elements defer src="js/all.min.js"></script>
    <script src="js/feather.min.js"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <?php
            if (isset($_POST['submit'])) {
                $firstName=$_POST['first-name'];
                $lastName=$_POST['last-name'];
                $fullName=$firstName." ".$lastName;
                $nickname = trim($_POST['nickname']);
                $emailAddress = trim($_POST['email-address']);
                $password = trim($_POST['password']);
                $confirmPassword = trim($_POST['confirm-password']);

                $sqlemail="select * from users where email=:email";
                $statmentEmail=$pdo->prepare($sqlemail);
                $statmentEmail->execute([
                        ':email'=>$emailAddress
                ]);
                $countEmail=$statmentEmail->rowCount();

                $sqlNickname="select * from users where nickname=:nickname";
                $statmentNickname=$pdo->prepare($sqlNickname);
                $statmentNickname->execute([
                    ':nickname'=>$nickname
                ]);
                $countNickname=$statmentNickname->rowCount();

                if($countNickname !=0) {
                    $nicknameExist = "nickname already exist ";
                }else if($countEmail !=0){
                    $emailExist="email already exist ";
                }else if($password != $confirmPassword){
                    $errors="password not match !!!";
                }else{
                    $hachedPassword=password_hash($password,PASSWORD_BCRYPT,['cost'=>10]);
                    $sql="insert into users (name,nickname,email,password,photo,registeredOn) values (:name,:nickname,:email,:password,:photo,:registeredOn)";
                    $statment=$pdo->prepare($sql);
                    $statment->execute([
                        ':name'=>$fullName,
                        ':email'=>$emailAddress,
                        ':nickname'=>$nickname,
                        ':password'=>$hachedPassword,
                        ':photo'=>'default-logo.png',
                        'registeredOn'=>date("M n, Y").' at '.date("h:i A")
                    ]);
                    $success=true;
                }
            }
            ?>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header justify-content-center"><h3 class="font-weight-light my-4">Create
                                    Account</h3></div>
                            <div class="card-body">
                                <form action="signup.php" method="POST">
                                    <?php
                                    if(isset($nicknameExist)){
                                        echo "<p class='alert alert-danger'>{$nicknameExist}</p>";
                                    }else if(isset($emailExist)){
                                        echo "<p class='alert alert-danger'>{$emailExist}</p>";
                                    }else if(isset($errors)) {
                                        echo "<p class='alert alert-danger'>{$errors}</p>";
                                    }else if(isset($success)){
                                        echo "<p class='alert alert-success '>
                                        user was created succesfully . please <a href='signin.php'>Sign in now</a> 
                                        </p>";
                                    }
                                    ?>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputFirstName">First Name</label>
                                                <input name="first-name" class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label>
                                            <input name="last-name" class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Nick Name</label>
                                        <input name="nickname" class="form-control py-4" id="inputNickName" type="text" aria-describedby="emailHelp" placeholder="Enter nick name"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input name="email-address" class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address"/>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input  name="password" class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password"/></div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputConfirmPassword">Confirm Password</label>
                                                <input  name="confirm-password" class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password"/></div>
                                        </div>
                                    </div>
                                    <div class="form-group mt-4 mb-0">
                                        <button name="submit" class="btn btn-primary btn-block" type="submit">Create Account</button>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="signin.php">Have an account? Go to signin</a></div>
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
