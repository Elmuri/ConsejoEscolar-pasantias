<?php
include 'db/conexion.php';

// if (isset($_POST['Ingresar'])) {
    if (empty($_POST['correo']) && empty($_POST['pass']) || empty($_POST['pass']) || empty($_POST['correo'])) {
        $message = 'La información no fue ingresada';
        echo json_encode(array('error' => true, 'mensaje' => $message));
    }
    $password = $_POST['pass'];
    $pass_db = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("SELECT * FROM `users` WHERE correo=:correo");
    $stmt->bindParam(':correo', $_POST['correo']);
    $stmt->execute();
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    if (password_verify($password, $results['pass'])) {
        session_start();
        $message = 'Inicio de sección exitoos';
        echo json_encode(array('error'=>false, 'mensaje' => $message));
        $_SESSION['usuario'] = $results['user'];
    } else {
        $message = 'La información ingresada es erronea';
        echo json_encode(array('error' => true, 'mensaje' => $message));
    }
// }
