<?php
include 'db/conexion.php';

if (empty($_POST['correo']) && empty($_POST['pass'])) {
    $message = 'El correo y la contraseña no fueron ingresadas.';
    echo json_encode(array('error' => true, 'mensaje' => $message));
    return;
}
if(empty($_POST['correo'])){
    $message = 'El correo no fue ingresado.';
    echo json_encode(array('error' => true, 'mensaje' => $message));
    return;
}
if(empty($_POST['pass'])){
    $message = 'La contraseña no fue ingresada.';
    echo json_encode(array('error' => true, 'mensaje' => $message));
    return;
}

$password = $_POST['pass'];
$pass_db = password_hash($password, PASSWORD_DEFAULT);
$stmt = $conn->prepare("SELECT * FROM `users` WHERE correo=:correo");
$stmt->bindParam(':correo', $_POST['correo']);
$stmt->execute();
$results = $stmt->fetch(PDO::FETCH_ASSOC);
if (password_verify($password, $results['pass'])) {
    session_start();
    $message = 'Inicio de sección exitoso';
    echo json_encode(array('error' => false, 'mensaje' => $message));
    $_SESSION['usuario'] = $results['user'];
} else {
    $message = 'La contraseña es invalida.';
    echo json_encode(array('error' => true, 'mensaje' => $message));
}
