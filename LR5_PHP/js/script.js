//строгий режим
"use strict"

//проверка, что документ загружен
document.addEventListener('DOMContentLoaded', function() {

    //перехватываем отправку формы
    const form1 = document.getElementById('form1');
    const form2 = document.getElementById('form2');

    //при отправке формы переходим в функцию formSend
    if (form1) {
        // Submit button
        form1.addEventListener('submit', formSend1);
    }
    if (form2) {
        // Submit button
        form2.addEventListener('submit', formSend2);
    }

    async function formSend1(e) {
        //запрещаем стандартную отправку формы
        e.preventDefault();

        let error = formValidate1(form1);
        let formData = new FormData(form1);

        //проверка ошибок валидации
        if (error === 0) {
            form1.classList.add('_sending_one');
            let response = await fetch('form_one.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                let result = await response.json();

                if (result.already_sent === 1) {
                    $('#modal_unsent').fadeIn();
                } else {
                    $('#modal_sent').fadeIn();
                }

                form1.reset();
                form1.classList.remove('_sending_one');
            } else {
                alert("Ошибка");
                form1.classList.remove('_sending_one');
            }
        } else {
            alert('Заполните обязательные поля');
        }
    }

    function formValidate1(form1) {
        let error = 0;

        //присваиваем переменной все объекты класса req
        let formReq = document.querySelectorAll('._req_one');

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

            if (input.value === '') {
                formAddError(input);
                error++;
            }
        }
        return error;
    }

    //добавляет самому объекту класс error и родительскому объекту класс error
    function formAddError(input) {
        input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }

    //убирает самому объекту класс error и родительскому объекту класс error
    function formRemoveError(input) {
        input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }

    //функция проверки email
    function emailTest(input) {
        return !/^\w+([\.-]?\w+)*@\w+([\,-]?\w+)*(\.\w{2,8})+/.test(input.value);
    }


    async function formSend2(e) {
        //запрещаем стандартную отправку формы
        e.preventDefault();

        let error = formValidate2(form2);
        let formData = new FormData(form2);

        //проверка ошибок валидации
        if (error === 0) {
            form2.classList.add('_sending_two');
            let response = await fetch('form_two.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                let result = await response.json();

                if (result.already_sent === 1) {
                    $('#modal_unsent').fadeIn();
                } else {
                    $('#modal_sent').fadeIn();
                }

                form2.reset();
                form2.classList.remove('_sending_two');
            } else {
                alert("Ошибка");
                form2.classList.remove('_sending_two');
            }
        } else {
            alert('Заполните обязательные поля');
        }
    }

    function formValidate2(form2) {
        let error = 0;
        //присваиваем переменной все объекты класса req
        let formReq = document.querySelectorAll('._req_two');

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

            if (input.value === '') {
                formAddError(input);
                error++;
            }
        }
        return error;
    }

});