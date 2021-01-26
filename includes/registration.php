<?php
if (isset($_POST['reset']))
    {

        if (isset($_SESSION['login'])) {
            session_destroy();
            unset($_SESSION['login']);
            unset($_SESSION['nickname']);
            unset($_SESSION['role']);
            header("Location: index.php");
        }

        if (isset($_COOKIE['_uid_']) && isset($_COOKIE['_unickname_'])) {
            setcookie('_uid_', '', time() - 60 * 60 * 24, '/', '', '', true);
            setcookie('_unickname_', '', time() - 60 * 60 * 24, '/', '', '', true);
        }
        header("Location: {$currentPage}");
    }

    if (isset($_SESSION['login'])) { ?>
        <form action="<?php echo $currentPage?>" method="post">
            <button name="reset" class="btn-teal btn rounded-pill px-4 ml-lg-4">Sign Out
                (<?php echo $_SESSION['nickname']; ?>)<i class="fas fa-arrow-right ml-1"></i></button>
        </form>


    <?php } else {
        if (!isset($_COOKIE['_uid_']) && !isset($_COOKIE['_unickname_'])) {
            echo ' 33 not difine index home';
            echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signin.php">Sign in<i class="fas fa-arrow-right ml-1"></i></a>';
            echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signup.php">Sign up<i class="fas fa-arrow-right ml-1"></i></a>';
        } else {
            $userId = base64_decode($_COOKIE['_uid_']);
            $userNickName = base64_decode($_COOKIE['_unickname_']);


            $sql = "select * from users where nickname=:nickname and id=:id";
            $sqlStatement = $pdo->prepare($sql);
            $sqlStatement->execute([
                ':id' => $userId,
                ':nickname' => $userNickName
            ]);
            $getUser = $sqlStatement->fetch(PDO::FETCH_ASSOC);
            $getUserNickName = $getUser['nickname'];
            $getUserRole = $getUser['role'];
            $_SESSION['nickname'] = $getUserNickName;
            $_SESSION['role'] = $getUserRole;
            $_SESSION['login'] = 'success';?>

            <form action="<?php echo $currentPage?>" method="post">
                <button name="reset" class="btn-teal btn rounded-pill px-4 ml-lg-4">Sign Out
                    (<?php echo $_SESSION['nickname']; ?>)<i class="fas fa-arrow-right ml-1"></i></button>
            </form>

       <?php }
    }
?>