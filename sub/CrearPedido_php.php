<?php
include './db/conexion.php';

// if (isset($_POST['Archivar'])) {
$mensaje = null;
// NOTE - comprobando que los campos no esten vacios
if (empty($_POST['empresa']) || empty($_POST['tel']) || empty($_POST['Rubro']) || empty($_POST['detalle']) || empty($_POST['Fecha_de_pedido']) || empty($_POST['escuela'])) {
    $mensaje = "Los campos obligatorios (*) no fueron completados.";
    echo json_encode(array('error' => true, 'mensaje' => $mensaje));
    return;
}
// NOTE - Creando la secuencia sql
$sql = $conn->prepare('INSERT INTO `pedidos`(`Empresa`, `Tel`, `Rubro`, `Detalle`, `Fecha_de_pedido`, `Fecha_de_realizacion`, `Escuela`) VALUES (?, ?, ?, ?, ?, ?, ?)');
$sql->bindParam(1, $_POST['empresa']);
$sql->bindParam(2, $_POST['tel']);
$sql->bindParam(3, $_POST['Rubro']);
$sql->bindParam(4, $_POST['detalle']);
$sql->bindParam(5, $_POST['Fecha_de_pedido']);
$sql->bindParam(6, $_POST['Fecha_de_realizacion']);
$sql->bindParam(7, $_POST['escuela']);

//NOTE - verificacion para que no aya datos repetidos
$pedidos = $conn->prepare("SELECT * FROM pedidos where 1");
$pedidos->execute();
$result_pedidos = $pedidos->fetchAll();

$p = null;

if (is_countable($result_pedidos)) {
    if (count($result_pedidos) != 0) {
        $p = $result_pedidos;
    }
}

foreach ($p as $row_p) :
    if ($_POST['empresa'] == $row_p['Empresa'] && $_POST['tel'] == $row_p['Tel'] && $_POST['Rubro'] == $row_p['Rubro'] && $_POST['Fecha_de_pedido'] == $row_p['Fecha_de_pedido'] && $_POST['Fecha_de_realizacion'] == $row_p['Fecha_de_realizacion'] && $_POST['escuela'] == $row_p['Escuela']) {
        $mensaje = "El pedido ya fue registrado.";
        echo json_encode(array('error' => true, 'mensaje' => $mensaje));
        return;
    }
endforeach;

// NOTE - ejecutando la seciencia sql
if ($sql->execute()) {
    $mensaje = "Pedido Registrado.";
    echo json_encode(array('error' => false, 'mensaje' => $mensaje));
}
// }
