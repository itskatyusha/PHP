<?php

require 'vendor/connection.php';

$fio_two = $_POST['fio_two'];
$email_two = $_POST['email_two'];

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

$fio_two = mysqli_real_escape_string($link,$_POST['fio_two']);
$email_two = mysqli_real_escape_string($link,$_POST['email_two']);

// выполняем операции с базой данных
$query ="INSERT INTO clients2021 (mail_client, name_client) VALUES ('$email_two', '$fio_two')";
$result = mysqli_multi_query($link, $query) or die("Ошибка " . mysqli_error($link));

$response = ['fio_two' => $fio_two,
    'email_two' => $email_two
];

header('Content-type: application/json');
echo json_encode($response);
