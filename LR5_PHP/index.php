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
        <form method="POST" action="#" id="form1" class="form__body">
            <h1 class="form__title">С защитой от SQL-инъекций</h1>
            <div class="form__item">
                <label for="formEmail" class="form__label">Почта* :</label>
                <input id="formEmail" type="text" name="email_one" class="form__input _req_one _email">
            </div>
            <div class="form__item">
                <label for="formName" class="form__label">Имя* :</label>
                <input id="formName" type="text" name="fio_one" class="form__input _req_one">
            </div>

            <button type="submit" class="form__button open-info">Подписаться</button>

            <div class="info__after open-info" id ="modal_sent">
                <div class="info">
                    <h4 class="mes mes__string"></h4>
                    <br>
                    <div class="string">
                        Готово!
                    </div>
                    <br>
                </div>
            </div>

        </form>
    </div>

    <div class="form">
        <!--объявляем форму-->
        <form method="POST" action="#" id="form2" class="form__body">
            <h1 class="form__title">Без защиты от SQL-инъекций</h1>
            <div class="form__item">
                <label for="formEmail" class="form__label">Почта* :</label>
                <input id="formEmail" type="text" name="email_two" class="form__input _req_two _email">
            </div>
            <div class="form__item">
                <label for="formName" class="form__label">Имя* :</label>
                <input id="formName" type="text" name="fio_two" class="form__input _req_two">
            </div>

            <button type="submit" class="form__button open-info">Подписаться</button>

            <div class="info__after open-info" id ="modal_sent">
                <div class="info">
                    <h4 class="mes mes__string"></h4>
                    <br>
                    <div class="string">
                        Готово!
                    </div>
                    <br>
                </div>
            </div>

        </form>
    </div>

</div>

<script src="js/script.js"></script>
</body>
</html>