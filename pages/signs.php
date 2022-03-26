<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Записаться</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<?php require "../blocks/header.php";

$services_id = filter_var(trim($_POST['id']),
    FILTER_SANITIZE_STRING);
if ($_COOKIE["user_id"] != '') {
    $user_id = $_COOKIE["user_id"];
    $mysqli = new mysqli('localhost', 'root', '', 'register');

    if ($mysqli->connect_errno) {
        printf("Соединение не удалось: %s\n", $mysqli->connect_error);
        exit();
    }

    $query = "SELECT users.name users_name
                    FROM  users 
                      where users.id = '$user_id' ";
    $query2 = "SELECT TIME_FORMAT(t.mydate, '%H:%i'),
t.mydate,
		 TIME_FORMAT(DATE_ADD(t.mydate, INTERVAL 30 MINUTE), '%H:%i')
from (SELECT
        DATE('2010/01/01 09:00:00') + INTERVAL(seq * 30) MINUTE AS mydate
    FROM
        seq_0_to_10) t";
    $users = $mysqli->query($query);
    $user = $users->fetch_assoc();
    $mysqli->close();


}
?>
<div class="container mt-4">

    <div class="row">
        <div class="col">
            <h1>Форма записи</h1>
            <form action="select_time.php" method="post">
                <input type="hidden" name="services_id" id="services_id" value="<?= $services_id ?>">
                <input type="text" class="form-control" name="name"
                       id="name" placeholder="Введите ваше имя" value="<?= $user["users_name"] ?>"><br>
                <input type="phone" class="form-control" name="phone"
                       id="phone" placeholder="Введите номер телефона"><br>
                <input type="date" class="form-control" name="date"
                       id="date"><br>
                <button class="btn btn-success" type="submit">Выбрать время</button>
            </form>
        </div>

    </div>
</div>
</body>
</html>