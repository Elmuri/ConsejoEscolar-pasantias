<?php

    include './db/conexion.php';

    if(isset($_POST['Registrarse'])){

    $user=$_POST['user'];
    $email=$_POST['correo'];
    $correoConfirm=$_POST['correo_confirm'];
    $pass=$_POST['pass'];
    $pass_confirm= $_POST['pass_confirm'];
    $tel=$_POST['tel'];

    if($pass != $pass_confirm){
        echo "<script>alert('Las contraseñas no concuerdan')</script>";
        header('refresh:1s;');
        return;
    }
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

     if($email != $correoConfirm){
        echo "<script>alert('Los correos no concuerdan')</script>";
        header('refresh:1s;');
        return;
    }

    $sql=$conn->prepare('INSERT INTO users (user, pass, telefono, correo) VALUES (?, ?, ?, ?) ');
    $sql->bindParam(1,$user);
    
    $sql->bindParam(2,$password);
    $sql->bindParam(3,$tel);
    $sql->bindParam(4,$email);
    // verificacion para que no aya datos repetidos
        $usuarios = $conn->prepare("SELECT * FROM users where 1");
        $usuarios->execute();
        $result_users = $usuarios->fetchAll();

        $u = null;
        
        if (is_countable($result_users)) {
            if (count($result_users) != 0) {
                $u = $result_users;
            }
        }

        foreach ($u as $row_u) :
            if ($_POST['tel'] == $row_u['telefono']) {
                echo "<script>alert('El numero de telefono ya fue utilizado')</script>";
                header('refresh:1;');
                return;
            }
            if ($_POST['user'] == $row_u['user']) {
                echo "<script>alert('El usuario ya fue utilizado')</script>";
                header('refresh:1;');
                return;
            }
            if ($_POST['correo'] == $row_u['correo']){
                echo "<script>alert('El correo ya fue utilizado')</script>";
                header('refresh:1;');
                return;
            }
        endforeach;
        if ($sql->execute()) {
            echo '<script>alaert("Se creó el usuario correctamente");</script>';
            $message = 'Se creó el usuario correctamente';
            header('Location:login.php');
        }       
 
    }
?>
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
                <input type="submit" name="Registrarse" value="Registrarse">
            </div>
        </form>
    </div>
</body>

</html>