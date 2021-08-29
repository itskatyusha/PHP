<?php

require 'vendor/connection.php';

$fio_one = $_POST['fio_one'];
$email_one = $_POST['email_one'];

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");

// выполняем операции с базой данных
$query ="INSERT INTO clients2021 (mail_client, name_client) VALUES ('$email_one', '$fio_one')";
$result = mysqli_multi_query($link, $query) or die("Ошибка " . mysqli_error($link));

//multi

$response = ['fio_one' => $fio_one,
    'email_one' => $email_one
];

header('Content-type: application/json');
echo json_encode($response);
