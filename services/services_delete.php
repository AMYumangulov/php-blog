<?php
$service_id = filter_var(trim($_POST['id']),
    FILTER_SANITIZE_STRING);

$mysql = new mysqli('localhost', 'root', '', 'register');

$mysql->query("delete from `services` where `id` = '$service_id' ");

$mysql->close();

header('Location: /services.php');
?>