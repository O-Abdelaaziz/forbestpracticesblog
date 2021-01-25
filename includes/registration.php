<?php
if(isset($_SESSION['login'])){ ?>
    <form action="singout.php">
        <button class="btn-teal btn rounded-pill px-4 ml-lg-4" >Sign Out (<?php echo $_SESSION['nickname']; ?>)<i class="fas fa-arrow-right ml-1"></i></button>
    </form>


<?php } else{
    if(!isset($_COOKIE['_uid_']) && !isset($_COOKIE['_unickname_'])){
        echo ' 33 not difine index home';
        echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signin.php">Sign in<i class="fas fa-arrow-right ml-1"></i></a>';
        echo '<a class="btn-teal btn rounded-pill px-4 ml-lg-4" href="backend/signup.php">Sign up<i class="fas fa-arrow-right ml-1"></i></a>';
    }else{
        $userId=base64_decode($_COOKIE['_uid_']) ;
        $userNickName=base64_decode($_COOKIE['_unickname_']);

        echo $userId.''.$userNickName.' 39 index home';

        $sql="select * from users where nickname=:nickname and id=:id";
        $sqlStatement=$pdo->prepare($sql);
        $sqlStatement->execute([
            ':id'=>$userId,
            ':nickname'=>$userNickName
        ]);
        $getUser=$sqlStatement->fetch(PDO::FETCH_ASSOC);
        $getUserNickName=$getUser['nickname'];
        $getUserRole=$getUser['role'];
        echo '
                <form action="singout.php">
                    <button class="btn-teal btn rounded-pill px-4 ml-lg-4" >Sign Out (<?php echo $getUserNickName; ?>)<i class="fas fa-arrow-right ml-1"></i></button>
                </form>
            ' ;
        $_SESSION['nickname'] = $getUserNickName;
        $_SESSION['role'] = $getUserRole;
        $_SESSION['login'] = 'success';
    }
}
?>