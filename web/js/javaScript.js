function addEventListeners() {

    $('.login-dropdown').on('click', function (e) {
        e.stopPropagation();
        $(".js-keep-open").attr('aria-expanded', true);
    });


    $('.dropdown-toggle').on('click', function () {
        $('#login').toggleClass('lightbrown');
    })

    $('#do_login').on('click', function (e) {
        e.preventDefault();
        do_login();
    })


    $("#register-button").on('click', function (e) {
        if (validate_error()) {
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
}

//  $("#login").on("click", function () {
//  if (!$(this).find('span').length > 0) {
//  $("#form").append('<span id=\'myForm\'></span>');
//     addLoginTable()
//  } else {
//      removeLoginTable();
//   }
//})


addEventListeners();

function validate_error() {

    $(".text-error").remove();

    let username_error = false;
    let password_error = false;
    let email_error = false;

    let username = $('#registerform-username');
    if (username.val().length < 4) {
        username.after('<span class="text-error for-username">Логин должен быть больше 3 символов</span>');
        username_error = true;
    }
    let password = $('#registerform-password');
    if (password.val().length < 6) {
        password.after('<span class="text-error for-pass">Пароль должен быть не менее 6 символов</span>');
        password_error = true;
    }
    let email = $('#registerform-email');
    let reg = /^\w+([.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
    if (email.val().length < 6) {
        email.after('<span class="text-error for-email">Email должен быть не менее 6 символов</span>');
        email_error = true;
    } else if (!reg.test(email.val())) {
        email.after('<span class="text-error for-email">Вы указали недопустимый e-mail</span>');
        email_error = true;
    }
    return username_error || password_error || email_error;
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

function do_login() {

    let myForm = [];
    $('#login').find('input').each(function (index) {
        myForm[index] = $(this).val();
    });
    let data = {};
    data['username'] = myForm[0];
    data['password'] = myForm[1];
    data['rememberMe'] = ($("input:checkbox").prop("checked"));
    data = JSON.stringify(data);
    $.ajax({
        type: "POST",
        url: '/web/form/dynlogin',
        dataType: 'json',
        data: {data: data},
        success: function (result) {
            if (result === true) {
                document.location.href = "/web/";
            } else {
                let errorMessage = "<p><button class = 'errorMessage'> Неверное имя или пароль</button></p>";
                $("#login").prepend(errorMessage);
            }
        }
    })
}
