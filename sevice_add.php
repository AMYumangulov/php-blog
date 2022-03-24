<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Добавить услугу</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <?php
    $service_id = filter_var(trim($_POST['id']),
        FILTER_SANITIZE_STRING);

    $mysqli = new mysqli('localhost', 'root', '', 'register');

    if ($mysqli->connect_errno) {
        printf("Соединение не удалось: %s\n", $mysqli->connect_error);
        exit();
    }

    $query = "SELECT * FROM `services` where `id` = '$service_id'";

    $services = $mysqli->query($query);
    $service = $services->fetch_assoc();

    $mysqli->close();
    ?>
    <form action="services/<?php

    if ($service_id == '') {
        echo 'services_add.php';
    } else {
        echo 'services_edit.php';
    }
    ?>" method="post">
        <input type="hidden" name="id" value="<?= $service_id ?>">
        <input type="text" class="form-control" name="service_name"
               id="service_name" placeholder="Наименование услуги" value="<?= $service["name"] ?>"><br>
        <input type="text" class="form-control" name="service_price"
               id="service_price" placeholder="Цена" value="<?= $service["price"] ?>"><br>
        <input type="text" class="form-control" name="service_dur"
               id="service_dur" placeholder="продолжительность" value="<?= $service["duration"] ?>"><br>
        <button class="btn btn-success" type="submit">

            <?php
            if ($service_id == '') {
                echo 'Добавить';
            } else {
                echo 'Изменить';
            }
            ?>
        </button>
    </form>
</div>
</body>
</html>