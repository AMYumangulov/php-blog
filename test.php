<?php
$mysqli = new mysqli('localhost', 'root', '', 'register');

/* проверка соединения */
if ($mysqli->connect_errno) {
    printf("Соединение не удалось: %s\n", $mysqli->connect_error);
    exit();
}

$query = "SELECT * FROM `services` where `user` = 3";

if ($res2 = $mysqli->query($query)) {

    /* извлечение ассоциативного массива */
    while ($row = $res2->fetch_assoc()) {

        echo  $row["name"]."\n".$row["price"];



    }

    /* удаление выборки */
    $res2->free();
}

/* закрытие соединения */
$mysqli->close();
?>