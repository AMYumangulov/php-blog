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
    <?php require "blocks/header.php";?>

    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <h6 class=" pb-2 mb-0">Мои услуги</h6>

        <?php
        $user_id = $_COOKIE["user_id"];

        $mysqli = new mysqli('localhost', 'root', '', 'register');

        if ($mysqli->connect_errno) {
            printf("Соединение не удалось: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "SELECT * FROM `services` where `user` = '$user_id'";

        if ($services = $mysqli->query($query)) {

            while ($service = $services->fetch_assoc()) {

                ?>
                <div class="mt-1">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around">
                            <p><?= $service["name"] ?></p>
                            <p><?= $service["price"] ?></p>
                            <form action="services/services_delete.php" method="POST">
                                <div class="d-flex justify-content-around">
                                    <input type="hidden" name="id" value="<?= $service["id"] ?>">
                                    <button class="btn btn-danger" type="submit">Удалить</button>
                                </div>
                            </form>
                            <form action="sevice_add.php" method="POST">
                                <div class="row-fluid">
                                    <input type="hidden" name="id" value="<?php echo $service["id"]; ?>">
                                    <button class="btn btn-warning" type="submit">Редактировать</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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