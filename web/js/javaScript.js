function addEventListeners() {
    //prevents login form from closing when clicked inside its borders
    $('.login-dropdown').on('click', function (e) {
        e.stopPropagation();
        $(".js-keep-open").attr('aria-expanded', true);
    });

    //changes login button color when login form is opened
    $('.dropdown-toggle').on('click', function () {
        $('#login').toggleClass('lightbrown');
    })

    //changes login button color back when login form is closed
    $(document).mouseup(function (e) {
       let myForm = $("#login");
        if (myForm.has(e.target).length === 0) { //unless the click occurs inside child elements of the login button
            $(myForm).removeClass('lightbrown');
        }
    });

    //validates user data from login form and sends it to server by ajax if validated
    $('#do_login').on('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        if (!validate_login_error()) {
            do_login();
        }
    })

    //validates user data from registration form and sends it to server by ajax if validated
    $("#register-button").on('click', function (e) {
        e.preventDefault();
        if (!validate_register_error()) {
            do_register();
        }
    });

    //validates user data from forgot password form and sends it to server by ajax if validated
    $('#restore-password-button').on('click', function (e) {
        e.preventDefault();
        $(".text-error").remove();
        if (!validate_email($('#user-email'))) {
            sendAjax_forgot_password();
        }
    })

    //validates user data from reset password form and sends it to server by ajax if validated
    $('#reset-password-button').on('click', function (e) {
        e.preventDefault();
        if (!validate_password($('#user-password'))) {
            sendAjax_reset_password();
        }
    })
}

addEventListeners();


function sendAjax_reset_password() {
    let yiiform = $('#password-reset');
    let password = $('#user-password');
    let token = $('#user-access_token');
    $.ajax({
        dataType: 'json',
        type: "POST",
        url: '/web/password-restore/vertoken?token='.token,
        data: yiiform.serializeArray(),
        success: function (result) {
            $(".text-error").remove();
            if (result === 'password saved') {
               // password.after('<span class="text-error for-email">Новый пароль успешно сохранен</span>');
                document.location.href = "/web/";
            }
             else {
                password.after('<span class="text-error for-email">Пароль не сохранен, попробуйте еще раз</span>');
            }
        }
    })
}


function sendAjax_forgot_password() {
    let yiiform = $('#password-restore');
    let email = $('#user-email');
    $.ajax({
        // type: yiiform.attr('method'),
        dataType: 'json',
        type: "POST",
        url: '/web/password-restore/restore',
        data: yiiform.serializeArray(),
        success: function (result) {
            if (result === 'this email is not registered') {
                $(".text-error").remove();
                email.after('<span class="text-error for-email">Такой пользователь не зарегистрирован</span>');
            } else if (result === 'email successfully sent') {
                $(".text-error").remove();
                email.after('<span class="text-error for-email">Письмо успешно отправлено, проверьте почту</span>');
            } else if (result === 'invalid email') {
                $(".text-error").remove();
                email.after('<span class="text-error for-email">Такой почты не существует</span>');
            }
        }
    })
    return false;
}

//returns true in case of validation errors
function validate_username(username) {
    if (username.val().length < 4) {
        username.after('<span class="text-error for-username">Логин должен быть больше 3 символов</span>');
        return true;
    }
    return false;
}

//returns true in case of validation errors
function validate_password(password) {
    if (password.val().length < 6) {
        password.after('<span class="text-error for-password">Пароль должен быть не менее 6 символов</span>');
        return true;
    }
    return false;
}

//returns true in case of validation errors
function validate_email(email) {
    let reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    if (email.val().length < 6) {
        email.after('<span class="text-error for-email">Email должен быть не менее 6 символов</span>');
        return true;
    } else if (!reg.test(email.val())) {
        email.after('<span class="text-error for-email">Вы указали недопустимый e-mail</span>');
        return true;
    }
    return false;
}

//returns true if at least one of the validation errors is true
function validate_register_error() {
    $(".text-error").remove();
    let username = $('#registerform-username');
    let password = $('#registerform-password');
    let email = $('#registerform-email');

    return validate_username(username) | validate_password(password) | validate_email(email);
}

//returns true if at least one of the validation errors is true
function validate_login_error() {
    $(".text-error").remove();
    let username = $('#loginForLoginForm');
    let password = $('#passwordForLoginForm');

    return validate_username(username) | validate_password(password);
}

//collects user data and sends it to server to log in the user
function do_login() {
    let data = {};
    data['username'] = $('#loginForLoginForm').val();
    data['password'] = $('#passwordForLoginForm').val();
    data['rememberMe'] = ($("input:checkbox").prop("checked"));
    data = JSON.stringify(data);
    console.log(data);
    $.ajax({
        type: "POST",
        url: '/web/login-form/login',
        dataType: 'json',
        data: {data: data},
        success: function (result) {
            if (result === 'login-completed') {
                document.location.href = "/web/";
            } else {
                let password = $('#passwordForLoginForm');
                password.after('<span class="text-error for-password">Неверное имя или пароль</span>');
            }
        }
    })
}

//collects user data and sends it to server to log in the user
function do_register() {
    let data = {};
    data['username'] = $('#registerform-username').val();
    data['password'] = $('#registerform-password').val();
    data['email'] = ($('#registerform-email').val());
    data = JSON.stringify(data);
    console.log(data);
    $.ajax({
        type: "POST",
        url: '/web/register-form/register',
        dataType: 'json',
        data: {data: data,  _csrf : yii.getCsrfToken()},
        success: function (result) {
            if (result === 'register-completed') {
                document.location.href = "/web/";
            } else {
                let email = $('#registerform-email');
                email.after('<span class="text-error for-email">Ошибка регистрации, попробуйте снова</span>');
            }
        }
    })
}

function logout() {
    $.ajax({
        type: "POST",
        url: '/web/form/dynlogout',
        success: function () {
            document.location.href = "/web/";
        }
    })
}


function sendAjaxx() {
    let form = $(this);
    // let data = {};
    // data['email'] = $('#passwordrestore-email').val();
    let data = form.serialize();

    // data = JSON.stringify(data);
    $.ajax({
        type: "POST",
        url: '/web/password-restore/restore',
        //  dataType: 'json',
        data: data,
        success: function (result) {
            alert(result);
            document.location.href = "/web/";
        }
    })
}

// type: form.attr('method'),
//  url: form.attr('action'),

//Если запрос отправлен
// .done(function(data) {
//Не прошла валидация с сервера
//    if (data.validation) {
//       alert('server validation failed')
//       form.yiiActiveForm('updateMessages', data.validation, true); // renders validation messages at appropriate places
//    } else {
//Рендр полученного шаблона в блок вместо формы(в моем случае список продуктов)
//  document.location.href = "/web/";
//  window.history.replaceState('admin', null, '/admin/feed/my-products')
//     }
// })
//  .fail(function () {
//      alert('Ошибка, попробуйте позже');
///   })
// Отменить синхронную отправку данных




