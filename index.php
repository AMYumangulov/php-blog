<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Форма регистрации</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php require "blocks/header.php" ?>
<div class="container mt-4 d-flex justify-content-around">
    <form action="index.php" method="post" class="container  d-flex justify-content-around">
        <input type="text" class="form-control" name="search" id="search" placeholder="Введите наименование услуги">
        <button class="btn btn-success" type="submit">Найти</button>
    </form>
</div>
<div class="container">
    <div class="my-3 p-3 bg-body rounded shadow-sm">

        <h6 class=" pb-2 mb-0">Услуги</h6>

        <?php
        $services_name = filter_var(trim($_POST['search']),
            FILTER_SANITIZE_STRING);
        $mysqli = new mysqli('localhost', 'root', '', 'register');

        if ($mysqli->connect_errno) {
            printf("Соединение не удалось: %s\n", $mysqli->connect_error);
            exit();
        }

        $query = "SELECT services.name services_name,
                         services.price,
                         services.duration,
                         users.name users_name
                    FROM services JOIN users 
                      ON services.user = users.id
                    WHERE lower(`services`.`name`) like '%' || lower('$services_name')  || '%'  ";

        if ($services = $mysqli->query($query)) {

            while ($service = $services->fetch_assoc()) {

                ?>
                <div class="mt-1">
                    <div class="card">
                        <div class="card-body d-flex justify-content-around">
                            <p><?= $service["users_name"] ?></p>
                            <p><?= $service["services_name"] ?></p>
                            <p><?= $service["price"] ?></p>
                            <form action="/" method="POST">
                                <div class="d-flex justify-content-around">
                                    <input type="hidden" name="id" value="<?= $service["id"] ?>">
                                    <button class="btn btn-success" type="submit">Записаться</button>
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

    </div>
</div>
</body>
</html>