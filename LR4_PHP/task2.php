<?php

require 'vendor/connection.php';

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

// получение ссылок, которые необходимо изменить
$old_link_req = "SELECT old_link FROM table1 WHERE new_link IS NULL";
$old_link = mysqli_query($link, $old_link_req) or die("Ошибка" . mysqli_error($link));

// получение старой ссылки из бд в нужном виде
function from_db($old_link)
{
    $table = array();
    while ($row = mysqli_fetch_all($old_link)) {
        $table = $row;
    }
    return $table;
}

$old_link = from_db($old_link);
$link_for_change = 'http://sozd.parlament.gov.ru/bill/<номер законопроекта>';

for ($i = 0; $i < count($old_link); $i++) {
    // получение номера законопроекта из старой ссылки
    preg_match("/([^\=][\d\-]+)\&[^\&]*$/", $old_link[$i][0], $result);
    $result = $result[1];

    // замена номера законопроекта в новой ссылке
    $new_link = preg_replace("/[^\/]+$/", $result, $link_for_change);

    // получение старой ссылки целиком
    $old_link_full = $old_link[$i][0];

    // замена старой ссылки на новую
    $query ="UPDATE table1 SET new_link = '$new_link' WHERE old_link = '$old_link_full'";
    $change_link = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
}
