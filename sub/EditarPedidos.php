<?php
include 'db/conexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $mensaje = null;
    $msg_title = null;

    $sql = $conn->prepare('SELECT * FROM `pedidos` WHERE id
        =:id');
    $sql->bindParam(':id', $_GET['id']);
    $sql->execute();
    // extrayendo datos de la db
    $result_pedidos = $sql->fetchAll();

    $p = null;

    if (is_countable($result_pedidos)) {
        if (count($result_pedidos) != 0) {
            $p = $result_pedidos;
        }
    }

    $escuela = $conn->prepare("SELECT * FROM escuelas where 1");
    $escuela->execute();
    $result_escuelas = $escuela->fetchAll();

    $e = null;

    if (is_countable($result_escuelas)) {
        if (count($result_escuelas) != 0) {
            $e = $result_escuelas;
        }
    }
    if (isset($_POST['editar'])) {

        $sql = $conn->prepare('UPDATE pedidos SET Empresa=:empresa,Tel=:tel,Rubro=:rubro,Detalle=:detalle,Fecha_de_pedido=:fecha_de_pedido,Fecha_de_realizacion=:fecha_de_realizacion,Escuela=:escuela,imagenes=:img WHERE id=:id');
        $sql->bindParam(':id', $id);
        $sql->bindParam(':empresa', $_POST['empresa']);
        $sql->bindParam(':tel', $_POST['tel']);
        $sql->bindParam(':rubro', $_POST['Rubro']);
        $sql->bindParam(':detalle', $_POST['detalle']);
        $sql->bindParam(':fecha_de_pedido', $_POST['Fecha_de_pedido']);
        $sql->bindParam(':fecha_de_realizacion', $_POST['Fecha_de_realizacion']);
        $sql->bindParam(':escuela', $_POST['escuela']);
        $sql->bindParam(':img', $img);

        if ($sql->execute()) {
            $msg_title = "Exitoso";
            $mensaje = "Espedido fue actualizado exitosamente.";
            // header("Refresh:0; url=../index.php");
        }
    }
}

if (isset($_GET['eliminar'])) {
?>
    <script>
        function ConfirmDelete() {
            let respuesta = confirm('Estas seguro de eliminar el pedido ID: <?php echo $_GET['eliminar']; ?>');
            if (respuesta == true) {
                alert('Pedido eliminado exitosamente');
                <?php
                $sql = $conn->prepare('DELETE FROM `pedidos` WHERE id=:id');
                $sql->bindParam(':id', $_GET['eliminar']);
                $sql->execute();
                header("Refresh:1; url=../index.php");
                ?>
            } else {
                alert('Pedido Cancelado');
                return;
            }
        }
        ConfirmDelete();
    </script>
<?php
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script defer src="/src/js/main.js"></script>
    <title>Editar | Borrrar pedidos</title>
</head>

<body>
    <?php if (isset($_GET['id'])) : ?>
        <?php include './div/heder.php'; ?>
        <?php
        // NOTE - verificando que el usuario alla iniciado sesión para ver la pagina
        if (!$_SESSION['usuario']) {
            echo '<script>alert("Por favor primero inicie sesión")</script>';
            header("Refresh:1; url=../index.php");
        }
        ?>
        <div class="conteinar shadow m-4 form-control">
            <form class="row m-4 g-3" action="<?php echo "EditarPedidos.php?id=" . $_GET['id']; ?>" method="post">
                <?php foreach ($p as $row_p) : ?>
                    <div class="col-12 col-md-4 d-flex">
                        <label class="form-label" value="<?php echo $row_p['id']; ?>" name="id"><?php echo "ID: " . $row_p['id']; ?></label>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-2">Empresa:</label>
                        <input type="text" value="<?php echo $row_p['Empresa']; ?>" placeholder="Nombre de la empresa" require class="form-control" name="empresa">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-2">Tel:</label>
                        <input type="text" value="<?php echo $row_p['Tel']; ?>" placeholder="Tel" require class="form-control" name="tel">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-2">Rubro:</label>
                        <input type="text" value="<?php echo $row_p['Rubro']; ?>" placeholder="Rubro" require class="form-control" name="Rubro">
                    </div>
                    <div class="my-3 col-12 col-md-4">
                        <label class="form-label mx-2 mb-2">Fecha del pedido:</label>
                        <input class="form-control" value="<?php echo $row_p['Fecha_de_pedido']; ?>" type="date" require name="Fecha_de_pedido">
                    </div>
                    <div class="my-3 col-12 col-md-4">
                        <label class="form-label mx-2 mb-2">Fecha de realización:</label>
                        <input class="form-control" value="<?php echo $row_p['Fecha_de_realizacion']; ?>" type="date" name="Fecha_de_realizacion">
                    </div>
                    <div class="my-3 col-12 col-md-4">
                        <label class="form-label mb-2">Escuela:</label>
                        <select class="form-control" name='escuela'>
                            <option selected><?php echo $row_p['Escuela']; ?></option>
                            <?php foreach ($e as $row) : ?>
                                <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Detalle:</label>
                        <textarea class="form-control" require placeholder="Detalle el pedido" name="detalle"><?php echo $row_p['Detalle']; ?></textarea>
                    </div>
                    <!-- FIXME - no se pudo desarollar la inserción de imagenes con dropzone -->
                    <!-- <div class="my-5 col-12 col-md-4">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imagen_carge">
                            Añadir imagenes
                        </button>
                    </div> -->
                    <div class="d-flex justify-content-center my-4">
                        <a href="../index.php" class="btn btn-danger mx-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary mx-2" name="editar">Editar</button>
                    </div>
                <?php endforeach; ?>
            </form>
        </div>
    <?php endif; ?>

    
</body>

</html>