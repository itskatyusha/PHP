<?php
// Подключаем библиотеку PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
require 'phpmailer/src/PHPMailer.php';
require 'vendor/connection.php';

// Создаем письмо
$mail = new PHPMailer();
$mail->CharSet = 'UTF-8';
$mail->setFrom('...', 'Заявка'); // от кого (mail и название)
$mail->addAddress('...', 'Екатерина');  // кому (email и имя)
$mail->Subject = 'Обратная связь';                         // тема письма

$fio = $_POST['fio'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];

$fio_space = preg_split('/\s+/', $fio);
$surname = $fio_space[0];
$name = $fio_space[1];
$patronymic = $fio_space[2];

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
mysqli_set_charset($link, "utf8");


putenv("TZ=Europe/Moscow");
$time_unix = time();
$time_now = date('Y-m-d H:i:s ', $time_unix);

// выполняем операции с базой данных
$time_last_req = "SELECT time_mail, email, id, time_unix FROM request2 WHERE email = '$email' ORDER BY time_mail DESC LIMIT 1";
$time_last = mysqli_query($link, $time_last_req) or die("Ошибка " . mysqli_error($link));
$time_last = mysqli_fetch_array($time_last);

$already_sent = 0;
$time_contact = 0;
$time_diff = 0;
$time_diff = $time_unix - $time_last[3];

if ($time_diff < 3600) {
    $already_sent = 1;
}

if ($time_diff >= 3600) {
    $query ="INSERT INTO request2 (fio, email, phone, comment, time_mail, time_unix) VALUES ('$fio', '$email', '$phone', '$comment', '$time_now', '$time_unix')";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
    $time_contact = $time_unix + 5400;
    $time_contact = date('H:i:s d.m.Y', $time_contact);
}

$time_diff = 3600 - ($time_unix - $time_last[3]);
$time_diff = date('i:s', $time_diff);

// вид отправленного письма
$mail->msgHTML("<html><body>
<h3>
ФИО: $fio <br>E-mail: $email <br>Номер телефона: $phone <br> Комментарий: $comment
</h3>
</html></body>");

// отправляем письмо
if ($already_sent === 0) {
    if ($mail->send()) {
        $message = 'Письмо отправлено!';
    } else {
        $message = 'Ошибка.';
    }
}

$response = ['message' => $message,
    'surname' => $surname,
    'name' => $name,
    'patronymic' => $patronymic,
    'email' => $email,
    'phone' => $phone,
    'comment' => $comment,
    'time_contact' => $time_contact,
    'time_diff' => $time_diff,
    'already_sent' => $already_sent
];

header('Content-type: application/json');
echo json_encode($response);
