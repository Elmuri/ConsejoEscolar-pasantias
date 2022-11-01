$(document).on('submit', '#form_log', function (event) {
    event.preventDefault();

    $.ajax({
        type: 'POST',
        url: '../sub/login_php.php',
        dataType: 'json',
        data: $(this).serialize(),
        beforeSend: function () {
            $('#Ingresar').val('Validando...');
        }
    })
        .done(function (respuesta) {
            // console.log(respuesta)
            if (!respuesta["error"] == true) {
                Toastify({
                    text: "Inicio de sesion exitoso! iniciando sistema...",
                    duration: 4000,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                   style: {
                        background: "black",
                        color: "aqua",
                        border:'1px aqua solid',
                    },
                }).showToast();

                setTimeout(function () {
                    location.href = "../index.php";
                }, 3000);
            } else {
                Toastify({
                    text: "La contraseña es incorrecta",
                    duration: 4000,
                    gravity: "top", // `top` or `bottom`
                    position: "right", // `left`, `center` or `right`
                    style: {
                        background: "black",
                        color: "aqua",
                        border: "1px aqua solid",
                    },
                }).showToast();
            }
            if (respuesta["error"] == null) {
                    Toastify({
                        text: "La sesion ya fue iniciada",
                        duration: 4000,
                        gravity: "top", // `top` or `bottom`
                        position: "right", // `left`, `center` or `right`
                        style: {
                            background: "black",
                            color: "aqua",
                            border: "1px aqua solid",
                        },
                    }).showToast();

                    setTimeout(function () {
                        location.href = "../index.php";
                    }, 2000);
            }
    })
    .fail(function (resp) {
        // console.log(resp)        
        Toastify({
            text: "Los datos ingresados no son validos",
            duration: 4000,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            style: {
                background: "black",
                color: "aqua",
                border: "1px aqua solid",
            },
        }).showToast();

        setTimeout(function () {
            $("#Ingresar").val("Erorr");
        }, 2000)
    })
    .always(function () {
        console.log("Complete")
        setTimeout(function () {
            $("#Ingresar").val("Ingresar");
        }, 3000);
        
    })
});