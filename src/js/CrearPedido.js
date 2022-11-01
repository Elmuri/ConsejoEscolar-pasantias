$(document).on("submit", "#form_CrearPedidos", function (event) {
    event.preventDefault();

    $.ajax({
        type: "POST",
        url: "../sub/CrearPedido_php.php",
        dataType: "json",
        data: $(this).serialize(),
        beforeSend: function () {
            $("#Archivar").val("Validando...");
        },
    })
        .done(function (respuesta) {
            // console.log(respuesta);
            if (respuesta["error"] == true) {
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
                setTimeout(function () {
                    location.href = "../index.php";
                }, 3000);
            }
        })
        .fail(function (resp) {
            // console.log(resp);
        })
        .always(function () {
            console.log("Completado");
        });
});