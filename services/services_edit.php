<?php
$service_id = filter_var(trim($_POST['id']),
    FILTER_SANITIZE_STRING);

$service_name = filter_var(trim($_POST['service_name']),
    FILTER_SANITIZE_STRING);
$service_price = filter_var(trim($_POST['service_price']),
    FILTER_SANITIZE_STRING);
$service_dur = filter_var(trim($_POST['service_dur']),
    FILTER_SANITIZE_STRING);

$user_id = $_COOKIE["user_id"];
$mysql = new mysqli('localhost', 'root', '', 'register');

$mysql->query("UPDATE `services` 
                     SET `name` = '$service_name',
                         `duration` = '$service_dur',
                         `price` = '$service_price'
                     WHERE `services`.`id` = '$service_id'");

$mysql->close();

header('Location: /services.php');
?>