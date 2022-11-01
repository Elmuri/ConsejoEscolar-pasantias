<?php
include './sub/db/conexion.php';
$pedidos = $conn->prepare("SELECT * FROM pedidos where 1");
$pedidos->execute();
$result_pedidos = $pedidos->fetchAll();

$p = null;

if (is_countable($result_pedidos)) {
    if (count($result_pedidos) != 0) {
        $p = $result_pedidos;
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>

<body>
    <?php include './sub/div/heder.php'; ?>
    <div class="conteinar m-4">
        <?php if (isset($p)) : ?>
            <?php foreach ($p as $row_p) : ?>
                <div class="card m-4">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo "Empresa: " . $row_p['Empresa']; ?></h5>
                        <p class="card-text"><?php echo "Tel: " . $row_p['Tel'] . " | " . "Rubro:", $row_p['Rubro'] . " | " . "Detalle: " . $row_p['Detalle'] . " | " . "Escuela: " . $row_p['Escuela']; ?>.</p>
                        <p class="card-text"><small class="text-muted"><?php echo "Fecha del pedido: " . $row_p['Fecha_de_pedido'] . " | " . "Fecha de realización: " . $row_p['Fecha_de_realizacion'] . " | " . "ID: " . $row_p['id']; ?></small></p>
                    </div>
                    <!-- FIXME - Todavia no es posible subir imagenes -->
                    <!-- <label class="form-label text-center text-info h4">Imagenes del pedido</label> -->
                    <!-- <div class="container-fluid d-flex justify-content-center">
                    <img src="Imagen del pedido" class="card-img-bottom" alt="Imagen del pedido">
                </div> -->
                    <?php if (isset($_SESSION['usuario'])) : ?>
                        <form class="d-flex justify-content-center m-3" action="sub/EditarPedidos.php" method="GET">
                            <button type="submit" value="<?php echo $row_p['id']; ?>" name="eliminar" class="btn btn-danger mx-2">Eliminar pedido</button>
                            <button type="submit" value="<?php echo $row_p['id']; ?>" name="id" class="btn btn-primary mx-2">Editar pedido</button>
                        </form>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>

</html>