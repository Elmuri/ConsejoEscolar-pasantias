<?php
include './db/conexion.php';
// FIXME - tendria que cambiarse para ser utilizado con ajax
// NOTE - Trayendo el nombre de las escuelas 
$escuela = $conn->prepare("SELECT * FROM escuelas where 1");
$escuela->execute();
$result_escuelas = $escuela->fetchAll();

$e = null;

if (is_countable($result_escuelas)) {
    if (count($result_escuelas) != 0) {
        $e = $result_escuelas;
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear pedidos</title>
</head>

<body>
    <?php include './div/heder.php'; ?>
    <div class="conteinar shadow m-4 form-control">
        <form class="row m-4 g-3" id="form_CrearPedidos" action="CrearPedido.php" method="post">
            <sup>Los campos que tengan (*) son obligatorios </sup>
            <div class="col-12 col-md-4">
                <label class="form-label mb-2">Empresa<sup class="text-danger">*</sup>:</label>
                <input type="text" placeholder="Nombre de la empresa" require class="form-control" name="empresa">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mb-2">Tel<sup class="text-danger">*</sup>:</label>
                <input type="text" placeholder="Tel" require class="form-control" name="tel">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mb-2">Rubro<sup class="text-danger">*</sup>:</label>
                <input type="text" placeholder="Rubro" require class="form-control" name="Rubro">
            </div>
            <div class="my-3 col-12 col-md-4">
                <label class="form-label mx-2 mb-2">Fecha del pedido<sup class="text-danger">*</sup>:</label>
                <input class="form-control" type="date" require name="Fecha_de_pedido">
            </div>
            <div class="my-3 col-12 col-md-4">
                <label class="form-label mx-2 mb-2">Fecha de realización:</label>
                <input class="form-control" type="date" name="Fecha_de_realizacion">
            </div>
            <div class="my-3 col-12 col-md-4">
                <label class="form-label mb-2">Escuela<sup class="text-danger">*</sup>:</label>
                <select class="form-control" name='escuela'>
                    <option selected value>Seleccione la escuela del pedido</option>
                    <?php foreach ($e as $row) : ?>
                        <option value="<?php echo $row['nombre'] ?>"><?php echo $row['nombre']; ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label">Detalle<sup class="text-danger">*</sup>:</label>
                <textarea class="form-control" require placeholder="Detalle el pedido" name="detalle"></textarea>
            </div>
            <!-- FIXME - no se pudo implementar la inserción de imagenes por medio de dropzone -->
            <!-- <div class="my-5 col-12 col-md-4">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#imagen_carge">
                        Añadir imagenes
                    </button>
                </div>
                <?php  //include 'modal/modalsupirImg.php'; 
                ?> -->
            <div class="d-flex justify-content-center my-4">
                <input type="submit" class="btn btn-primary" name="Archivar" value="Archivar">
            </div>
        </form>
    </div>
    <!-- LINK - scrips -->
    <script src="../src/js/jQuery.js"></script>
    <script src="../src/js/CrearPedido.js"></script>
</body>

</html>