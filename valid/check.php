<?php
$name = filter_var(trim($_POST['name']),
    FILTER_SANITIZE_STRING);
$login = filter_var(trim($_POST['login']),
    FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']),
    FILTER_SANITIZE_STRING);
if (mb_strlen($login) < 5 || mb_strlen($login) > 90) {
    echo 'Недопустимая длина логина ';
    exit;
} else if (mb_strlen($name) < 3 || mb_strlen($name) > 50) {
    echo 'Недопустимая длина имени ';
    exit;
}

$pass = md5($pass."lkhj;lkdsvc");

$mysql = new mysqli('localhost', 'root', '', 'register');

$mysql->query("insert into `users` (`login`, `pass`, `name`)
                        values ('$login', '$pass', '$name') ");

$mysql->close();

header('Location: /');
?>