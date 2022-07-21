

function addEventListeners() {

        $(document).mouseup( function(e){ // событие клика по веб-документу
            let myForm = $("#myForm" ); // тут указываем ID элемента
            if ( !myForm.is(e.target) // если клик был не по нашему блоку
                && myForm.has(e.target).length === 0 ) { // и не по его дочерним элементам
                myForm.remove(); // удаляем его
            }
        });

    $("#login").on("click", function () {
    if (!$(this).find('span').length > 0) {
    $("#form").append('<span id=\'myForm\'></span>');
        addLoginTable()
    } else {
        removeLoginTable();
    }
})

    $("#logout").on("click", function () {
       logout();
    })

}

addEventListeners();

function logout(){
    $.ajax({
        type: "POST",
        url: '/web/form/dynlogout',
        success: function (result) {
            document.location.href="/web/";
        }
})
}

function removeLoginTable() {
    $("#myForm").remove();
}

    function addLoginTable() {

        let form = "<form method='post' class = 'register_form'> " +

            "Имя пользователя <input type = 'text' <name = 'username' class = 'col-form-input'/> <id = 'username'/><p></p>" +
            "Пароль <input type = 'password' <name = 'password' class = 'col-form-input'/> <id = 'password'/><p></p>" +
            "<span class = 'medium'>Запомнить</span><input type = 'checkbox' class=\"myinput\" <name = 'rememberMe'/> <checked = 'checked'/>" +
            "<id ='rememberMe'/> <label for=\"rememberMe\"></label>" +
            "<p><button type=\"submit\" class = \"btn btn-warning\">Войти </button></p>" +
            "<a href = '/web/register-form/' class = 'smaller'>У вас нет аккаунта? Зарегистрироваться</a></form>";


        $("#myForm").append(form).submit(function (e) {
            //    document.querySelector('input').setAttribute('autofocus', 'autofocus');
            e.preventDefault(); // avoid to execute the actual submit of the form.
            let myForm = [];
            $('#myForm').find('input').each(function (index, value) {
                myForm[index] = $(this).val();
            });
            let data = {};
            data['username'] = myForm[0];
            data['password'] = myForm[1];
            data['rememberMe'] = ($("input:checkbox").prop("checked"));
            data = JSON.stringify(data);
            console.log(data);
            $.ajax({
                type: "POST",
                url: '/web/form/dynlogin',
                dataType: 'json',
                data: {data: data},
                success: function (result) {
                    if (result === true) {
                        $("#myForm").remove();
                        document.location.href="/web/";
                    } else {
                      let errorMessage = "<p><button class = 'errorMessage'> Неверное имя или пароль</button></p>";
                        $("#myForm").prepend(errorMessage);
                        }
                    }
            })
        })
    }
