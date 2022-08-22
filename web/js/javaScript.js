function addEventListeners() {

    $('.login-dropdown').on('click', function (e) {
        e.stopPropagation();
        $(".js-keep-open").attr('aria-expanded', true);
    });


    $('.dropdown-toggle').on('click', function () {
        $('#login').toggleClass('lightbrown');
        $('#loginForLoginForm').focus();
    })

    $('#do_login').on('click', function (e) {
        e.preventDefault();
        do_login();
    })


    $("#register-button").on('click', function (e) {
        if (validate_register_error()) {
            e.preventDefault();
        }
    });

    $(document).mouseup(function (e) { // событие клика по веб-документу
        let myForm = $("#login"); // тут указываем ID элемента
        if (!myForm.is(e.target)  // если клик был не по нашему блоку
            && myForm.has(e.target).length === 0) { // и не по его дочерним элементам
            $('#login').removeClass('lightbrown');
        }
    });


    $('#restore-password-button').on('click', function (e) {
        e.preventDefault();
      //  e.stopPropagation();
        if(!validate_email($('#passwordrestore-email'))) {
            sendAjax();
        }
           return false;
    })

    // $('#password-restore').on('beforeSubmit', function () {
    //     event.preventDefault(); // stopping submitting
    //     var data = $(this).serializeArray();
    //    //  var url = $(this).attr('action');
    //    $.ajax({
    //       url: '/web/form/dynlogout',
    //       type: 'post',
    //      dataType: 'json',
    //     data: data
    //  })
    //     .done(function (response) {
    //         if (response.data.success === true) {
    //            alert("Wow you commented");
    //        }
    //     })
    //   .fail(function () {
    //         console.log("error");
    //    });

    //    })
    //  })
}


//$('#restore-password-button').on("click", function (e) {
//  e.preventDefault();
//   if(!validate_email($('#passwordrestore-email'))) {
//      sendAjax();
//  }
//})

//  $("#login").on("click", function () {
//  if (!$(this).find('span').length > 0) {
//  $("#form").append('<span id=\'myForm\'></span>');
//     addLoginTable()
//  } else {
//      removeLoginTable();
//   }
//})


addEventListeners();

function sendAjax() {
let yiiform = $('#password-restore');
let email  = $('#passwordrestore-email');
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
            } else if (result === 'invalid email') {
                email.after('<span class="text-error for-email">Такой почты не существует</span>');
            }
        }
    })
    return false;
}


function validate_username(username) {
    if (username.val().length < 4) {
        username.after('<span class="text-error for-username">Логин должен быть больше 3 символов</span>');
        return true;
    }
    return false;
}


function validate_password(password) {
    if (password.val().length < 6) {
        password.after('<span class="text-error for-password">Пароль должен быть не менее 6 символов</span>');
        return true;
    }
    return false;
}


function validate_email(email) {
    $(".text-error").remove();
    let reg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;;
    if (email.val().length < 6) {
        email.after('<span class="text-error for-email">Email должен быть не менее 6 символов</span>');
        return true;
    } else if (!reg.test(email.val())) {
        email.after('<span class="text-error for-email">Вы указали недопустимый e-mail</span>');
        return true;
    }
}


function validate_register_error() {
    $(".text-error").remove();
    let username = $('#registerform-username');
    let password = $('#registerform-password');
    let email = $('#registerform-email');

    return validate_username(username) | validate_password(password) | validate_email(email);
}


function validate_login_error() {
    $(".text-error").remove();
    let username = $('#loginForLoginForm');
    let password = $('#passwordForLoginForm');

    return validate_username(username) | validate_password(password);
}


function do_login() {
    if (!validate_login_error()) {
        let data = {};
        data['username'] = $('#loginForLoginForm').val();
        data['password'] = $('#passwordForLoginForm').val();
        data['rememberMe'] = ($("input:checkbox").prop("checked"));
        data = JSON.stringify(data);
        $.ajax({
            type: "POST",
            url: '/web/form/dynlogin',
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
                .fail(function () {
                    document.location.href = "/web/";
                })
        })
    }
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




