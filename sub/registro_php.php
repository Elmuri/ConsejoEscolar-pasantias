<?php
include './db/conexion.php';

if (empty($_POST['user']) || empty($_POST['correo']) || empty($_POST['correo_confirm']) || empty($_POST['pass']) || empty($_POST['pass_confirm']) || empty($_POST['tel'])) {
    $message='Complete los campos';
    echo json_encode(array('error' => true, 'mensaje' => $message));
    return;
}

$user = $_POST['user'];
$email = $_POST['correo'];
$correoConfirm = $_POST['correo_confirm'];
$pass = $_POST['pass'];
$pass_confirm = $_POST['pass_confirm'];
$tel = $_POST['tel'];

if ($pass != $pass_confirm) {
    $message='Las contraseñas no concuerdan';
    echo json_encode(array('error' => true, 'mensaje' => $message));
    return;
}
$password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

if ($email != $correoConfirm) {
    $message='Los correos no concuerdan';
    echo json_encode(array('error' => true, 'mensaje' => $message));
    return;
}

$sql = $conn->prepare('INSERT INTO users (user, pass, telefono, correo) VALUES (?, ?, ?, ?) ');
$sql->bindParam(1, $user);
$sql->bindParam(2, $password);
$sql->bindParam(3, $tel);
$sql->bindParam(4, $email);
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
        $message='El numero de telefono ya fue utilizado';
        echo json_encode(array('error' => true, 'mensaje' => $message));
        return;
    }
    if ($_POST['user'] == $row_u['user']) {
        echo "<script>alert('El usuario ya fue utilizado.')</script>";
        header('refresh:1;');
        return;
    }
    if ($_POST['correo'] == $row_u['correo']) {
        $message='El correo ya fue utilizado.';
        echo json_encode(array('error' => true, 'mensaje' => $message));
        return;
    }
endforeach;
if ($sql->execute()) {
    $message = 'Se creó el usuario correctamente.';
    echo json_encode(array('error' => false, 'mensaje' => $message));
}
