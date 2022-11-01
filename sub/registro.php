<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <?php include '../sub/div/heder.php'; ?>

    <div class="conteiner m-4 shadow">
        <form class="form-control" id="form_registro" method="post">
            <div class="mb-3">
                <label class="form-label">Usuario:</label>
                <input type="text" class="form-control" require name="user">
                <label class="form-label">Correo:</label>
                <input type="email" class="form-control" require name="correo" placeholder="ejemplo@gmail.com">
                <label class="form-label">Confirmar el correo:</label>
                <input type="email" class="form-control" require name="correo_confirm" placeholder="ejemplo@gmail.com">
                <label class="form-label">contraseña:</label>
                <input type="password" class="form-control" require name="pass">
                <label class="form-label">Confirmar contraseña:</label>
                <input type="password" class="form-control" require name="pass_confirm">
                <label class="form-label">Telefono:</label>
                <input type="text" class="form-control" require name="tel">
            </div>
            <div class="d-flex justify-content-center">
                <input type="submit" class="btn btn-primary" id="Registrarse" name="Registrarse" value="Registrarse">
            </div>
        </form>
    </div>
    <!-- LINK - scrips -->
    <script src="../src/js/jQuery.js"></script>
    <script src="../src/js/Registro.js"></script>
</body>

</html>