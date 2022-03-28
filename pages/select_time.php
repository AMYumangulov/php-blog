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

    $query_service_prop = "select (UNIX_TIMESTAMP(services.work_time_to) - UNIX_TIMESTAMP(services.work_time_from)) / 60 as work_time,
                                      duration 
                                 from servicves
                                  and services.id = '$services_id'";


    $service_props = $mysqli->query($query_service_prop);
    $service_prop = $service_props->fetch_assoc();

    $query_interval = "SELECT TIME_FORMAT(t.mydate, '%H:%i'),
                              TIME_FORMAT( DATE_ADD(t.mydate, INTERVAL 30 MINUTE),'%H:%i' )
                         FROM (SELECT DATE('2010/01/01') + INTERVAL(9) HOUR + INTERVAL(seq * 30) MINUTE AS mydate
                                 FROM seq_0_to_10) t";


    $query_interval2 = "SELECT * from(SELECT TIME_FORMAT(t.mydate, '%H:%i') t_from,
                                             TIME_FORMAT(DATE_ADD(t.mydate, INTERVAL 40 MINUTE),'%H:%i') inter
                                        FROM ( SELECT DATE('2010/01/01') + INTERVAL(9) HOUR + INTERVAL(seq * 40) MINUTE AS mydate
                                                 FROM seq_0_to_13 ) t
                                      ) tt
                         WHERE  NOT exists (SELECT 1
                                                               FROM ( SELECT TIME_FORMAT(s.date, '%H:%i') t_from,
                                                                             TIME_FORMAT( DATE_ADD( s.date, 
                                                                                          INTERVAL(sr.duration) MINUTE ), '%H:%i' ) inter
                                                                        FROM `signs` AS s 
                                                                        JOIN `services` AS sr
                                                                          ON s.service = sr.id
                                                                       WHERE sr.user = 4 
                                                                         AND DATE(s.date) = '2022-03-27') period
                                                           where 
                                           					     (tt.t_from >= period.t_from  
                                           					     and tt.t_from < period.inter)
                                            					 or (tt.inter > period.t_from  
                                           					     and tt.inter <= period.inter)
                                           )";


    $query = "SELECT users.name users_name
                    FROM  users 
                      where users.id = '$user_id' ";

    $users = $mysqli->query($query);
    $user = $users->fetch_assoc();
    $mysqli->close();
}
?>
<div class="container mt-4">

    <div class="row">
        <div class="col">
            <h1>Форма записи</h1>
            <form action="signs.php" method="post">
                <input type="text" class="form-control" name="name"
                       id="name" placeholder="Введите ваше имя" value="<?= $user ?>"><br>
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