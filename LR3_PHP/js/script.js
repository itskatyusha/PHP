//строгий режим
"use strict"

//проверка, что документ загружен
document.addEventListener('DOMContentLoaded', function() {
    //перехватываем отправку формы
    const form = document.getElementById('form');
    //при отправке формы переходим в функцию formSend
    form.addEventListener('submit', formSend);

    async function formSend(e)
    {
        //запрещаем стандартную отправку формы
        e.preventDefault();

        let error = formValidate(form);
        let formData = new FormData(form);

        //проверка ошибок валидации
        if(error === 0) {
            form.classList.add('_sending');
            let response = await fetch('sendmail.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                let result = await response.json();
                //выводим пользователю ответ
                $('.mes').text(result.message);
                $('.surname').text(result.surname);
                $('.time_contact').text(result.time_contact);
                $('.already_sent').text(result.already_sent);
                $('.time_diff').text(result.time_diff);
                $('.name').text(result.name);
                $('.patronymic').text(result.patronymic);
                $('.email').text(result.email);
                $('.phone').text(result.phone);
                $('.comment').text(result.comment);

                // если письмо уже отправлено и не прошло 1.5 часа
                if (result.already_sent === 1) {
                    $('#modal_unsent').fadeIn();
                } else {
                    $('#modal_sent').fadeIn();
                }

                form.reset();
                form.classList.remove('_sending');
            } else {
                alert("Ошибка");
                form.classList.remove('_sending');
            }
        } else {
            alert('Заполните обязательные поля');
        }
    }

    function formValidate(form)
    {
        let error = 0;
        //присваиваем переменной все объекты класса req
        let formReq = document.querySelectorAll('._req');

        for (let index = 0; index < formReq.length; index++) {
            //получаем каждый объект в переменную
            const input = formReq[index];
            formRemoveError(input);

            if (input.classList.contains('_email')) {
                if (emailTest(input)) {
                    formAddError(input);
                    error++;
                }
            }

            if (input.classList.contains('_phone')) {
                if (phoneTest(input)) {
                    formAddError(input);
                    error++;
                }
            }

            if (input.value === '') {
                formAddError(input);
                error++;
            }
        }
        return error;
    }
    //добавляет самому объекту класс error и родительскому объекту класс error
    function formAddError(input)
    {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }

    //убирает самому объекту класс error и родительскому объекту класс error
    function formRemoveError(input)
    {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }

    //функция проверки email
    function emailTest(input)
    {
        return !/^\w+([\.-]?\w+)*@\w+([\,-]?\w+)*(\.\w{2,8})+/.test(input.value);
    }

    //функция проверки номера телефона
    function phoneTest(input) {
        return !/^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/.test(input.value);
    }
    
});
