<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Услуги</title>
</head>
<body>
<div class="container">


    <div class="my-3 p-3 bg-body rounded shadow-sm">
        <p>Чтобы выйти нажмите <a href="valid/exit.php">здесь</a></p>
        <h6 class="border-bottom pb-2 mb-0">Услуги</h6>

        <?php

        $mysqli = new mysqli('localhost', 'root', '', 'register');

        if ($mysqli->connect_errno) {
            printf("Соединение не удалось: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "SELECT * FROM `services` where `user` = 3";

        if ($services = $mysqli->query($query)) {

            while ($service = $services->fetch_assoc()) {

                ?>
                <form action="services/services_delete.php" method="POST">
                <div class="row-fluid">
                    <div class="span1"><p><?= $service["name"] ?><?= $service["price"] ?></p></div>
                    <input type="hidden" name="id" value="<?php echo $service["id"]?>">
                    <button class="btn btn-success" type="submit">Удалить</button>
                </div>
                </form>

                <?php


            }

            $services->free();
        }

        $mysqli->close(); ?>
        <a href="sevice_add.php">Добавить</a>
    </div>
</div>
</body>
</html>