$(document).ready(function () {

    $('.likedislike').click(function () {
        id = $(this).attr('data-id');
        value = $(this).attr('data-value');
        icon = $(this).find('i').first();
        _token = $('meta[name="csrf-token"]').attr('content')
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/public/film/ajax_like',
            data: {id: id, value: value, _token: _token},
            success: function (data) {

                if (data == 1) {
                    $('.likedislike').find('i').css('color', '#fff');
                    icon.css('color', '#9e0505');
                } else if (data == 2) {
                    $('.likedislike').find('i').css('color', '#fff');
                } else {
                    alert("PLEASE REFRESH PAGE");
                }

            }
        });
    })



    $('.btn-watch-watched-big').click(function () {
        id = $(this).attr('data-id');
        eye = $(this).find('i').first();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/public/film/ajax_watch',
            data: {id: id},
            success: function (watch) {
                if (watch == 1) {
                    if (eye.hasClass("color")) {
                        eye.removeClass("color");
                    } else {
                        eye.addClass("color");
                    }

                } else {
                    alert("PLEASE REFRESH PAGE");
                }


            }
        });
    })


    $('.btn-watch-want-big').click(function () {
        id = $(this).attr('data-id');
        late = $(this).find('i').first();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/public/film/ajax_later',
            data: {id: id},
            success: function (watch) {
                if (watch == 1) {
                    if (late.hasClass("color")) {
                        late.removeClass("color");
                    } else {
                        late.addClass("color");
                    }

                } else {
                    alert("PLEASE REFRESH PAGE");
                }


            }
        });
    })

    $(".unselect").click(function () {
        $(".catInp").prop('checked', false)
    });

    $(".unselectYear").click(function () {
        $(".yearsInp").prop('checked', false)
    });

    $('.dropdown-menu').bind('click', function (e) {
        e.stopPropagation()
    });


    $(".editProfile").click(function () {
        name_old = $(".valueName").text();
        email_old = $(".valueEmail").text();
        $(".valueName").text("");
        $(".valueEmail").text("");
        $(".valueEmail").append("<div class='form-group>\n\
                        <label for='updateEmail'></label>\n\
                 <input type='email' name='email' class='form-control' id='updateEmail' placeholder='Введите е-маил'></div>");
        $(".valueName").append("<div class='form-group>\n\
                        <label for='updateName'></label>\n\
                 <input type='text' name='updatename' class='form-control' id='updateName' placeholder='Введите имя'></div>");
        $("#exampleFormControlFile1").removeAttr("disabled");
        $("<button type='submit' class='btn btn-success updateprofile'>Обновить</button>").insertAfter("#exampleFormControlFile1");


    });








});


function sign() {
    $('#panel7').removeClass('active show');
    $('#panel8').addClass('active show');
    $('#log').removeClass('active');
    $('#reg').addClass('active');
}

function login() {
    $('#panel8').removeClass('active show');
    $('#panel7').addClass('active show');
    $('#reg').removeClass('active');
    $('#log').addClass('active');
}



