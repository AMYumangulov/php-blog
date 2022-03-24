<?php
$name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
$login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);


$pass = md5($pass."lkhj;lkdsvc");

$mysql = new mysqli('localhost', 'root', '', 'register');


$res = $mysql->query("select * from `users` where `login` = '$login' and `pass` = '$pass'");
$user = $res->fetch_assoc();
if(count($user) == 0){
    echo 'Такой пользователь не найден';
    exit();
}


$mysql->close();
setcookie("user", $user['name'], time() + 3600, "/");
setcookie("user_id", $user['id'], time() + 3600, "/");

//print_r($_COOKIE['TestCookie']);
header('Location: /services.php');
?>