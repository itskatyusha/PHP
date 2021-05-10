<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Обратная связь</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
<body>

<div class="wrapper">
    <div class="form">
        <!--объявляем форму-->
        <form action="#" id="form" class="form__body">
            <!--заголовок-->
            <h1 class="form__title">Обратная связь</h1>
            <!--ввод ФИО-->
            <div class="form__item">
                <label for="formName" class="form__label">ФИО* :</label>
                <input id="formName" type="text" name="fio" class="form__input _req">
            </div>
            <div class="form__item">
                <label for="formEmail" class="form__label">E-mail* :</label>
                <input id="formEmail" type="text" name="email" class="form__input _req _email">
            </div>
            <div class="form__item">
                <label for="formPhone" class="form__label">Телефон* :</label>
                <input id="formPhone" type="text" name="phone" class="form__input _req _phone">
            </div>
            <div class="form__item">
                <label for="formComment" class="form__label">Комментарий* :</label>
                <textarea name="comment" id="formComment" class="form__textarea _req"></textarea>
            </div>

            <button type="submit" class="form__button open-info">Отправить</button>

            <div class="info__after open-info" id ="modal">
                <div class="info">
                    <h3>
                        ФИО: $fio <br>
                        E-mail: <?php $fio; ?> <br>Номер телефона: $phone <br> Комментарий: $comment
                    </h3>
                </div>
            </div>

        </form>

    </div>
</div>

<script src="js/script.js"></script>

</body>
</html>