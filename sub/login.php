<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <?php
    include '../sub/div/heder.php';
    if(isset($_SESSION['usuario'])){
    ?>
        <script>
            Toastify({
                    text: "La sesion ya fue iniciada; Redireccionando...",
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
                }, 2000);
        </script>
    <?php
    }      
    ?>
    <div class="conteiner m-4">
        <form class="form-control" method="post" id="form_log">
            <div class="mb-3">
                <label class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" placeholder="ejemplo@gmail.com">
                <label class="form-label">contraseña:</label>
                <input type="password" class="form-control" name="pass">
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-primary" id="Ingresar" name="Ingresar" value="Ingresar">
            </div>
        </form>
        <div class="conteiner" id="erorr_view">

        </div>
    </div>
    <!-- LINK - scrips -->
    <script src="../src/js/jQuery.js"></script>
    <script src="../src/js/login.js"></script>
</body>

</html>