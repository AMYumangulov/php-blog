<?php
$service_name = filter_var(trim($_POST['service_name']),
    FILTER_SANITIZE_STRING);
$service_price = filter_var(trim($_POST['service_price']),
    FILTER_SANITIZE_STRING);
$service_dur = filter_var(trim($_POST['service_dur']),
    FILTER_SANITIZE_STRING);

$user_id = $_COOKIE["user_id"];


$mysql = new mysqli('localhost', 'root', '', 'register');

$mysql->query("insert into `services` (`name`, `price`, `duration`, `user`)
                        values ('$service_name', '$service_price', '$service_dur', '$user_id') ");

$mysql->close();

header('Location: /services.php');
?>