$(document).on("submit", "#form_registro", function (event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "../sub/registro_php.php",
        dataType: "json",
        data: $(this).serialize(),
        beforeSend: function () {
            $("#Registrarse").val("Validando...");
        },
    })
        .done(function (respuesta) {
            console.log(respuesta)
            if (!respuesta["error"] == true) {
                Toastify({
                    text: "Registro exitoso!! redireccionando al login...",
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
                    location.href = "login.php";
                }, 3000);
            } else {
                Toastify({
                    text: respuesta["mensaje"],
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
        })
        .fail(function (resp) {
            // console.log(resp)
            Toastify({
                text: resp["mensaje"],
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
            }, 2000);
        })
        .always(function () {
            console.log("Complete");
            setTimeout(function () {
                $("#Ingresar").val("Ingresar");
            }, 3000);
        });
});
