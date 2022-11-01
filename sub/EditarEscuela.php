<?php
include 'db/conexion.php';
if (isset($_GET['id'])) {

    $escuela = $conn->prepare("SELECT * FROM escuelas where id=:id");
    $escuela->bindParam(':id', $_GET['id']);
    $escuela->execute();
    $result_escuelas = $escuela->fetchAll();

    $e = null;

    if (is_countable($result_escuelas)) {
        if (count($result_escuelas) != 0) {
            $e = $result_escuelas;
        }
    }
}
if (isset($_GET['delete'])) {
    $escuela = $conn->prepare("SELECT * FROM escuelas where id=:id");
    $escuela->bindParam(':id', $_GET['delete']);
    $escuela->execute();
    $result_escuelas = $escuela->fetchAll();

    $e = null;

    if (is_countable($result_escuelas)) {
        if (count($result_escuelas) != 0) {
            $e = $result_escuelas;
        }
    }
    foreach($e as $row):
?>
    <script>
            var opcion = confirm('Estas seguro de eliminar la escuela ID: <?php echo $row['nombre']; ?> con todos los pedidos de esta Si o No ');
            if (opcion == true) {
                <?php
                $sql = $conn->prepare('DELETE FROM `escuelas` WHERE id=:id');
                $sql->bindParam(':id', $_GET['delete']);
                $sql2 = $conn->prepare('DELETE FROM `pedidos` WHERE escuela=:escuela');
                $sql2->bindParam(':escuela', $row['nombre']);
                if($sql->execute() && $sql2->execute()){
                echo "alert('Pedido eliminado exitosamente');";
                header("Refresh:1; url=./ver_editar_escuelas.php");
                }
                ?>
            } else {
                alert('Eliminación del Pedido Cancelado');
                header("Refresh:1; url=../index.php");
            }
    </script>
<?php
endforeach;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Escuela</title>
</head>

<body>
    <?php include './div/heder.php'; ?>
    <?php if (isset($_GET['id'])) : ?>
    <?php if (count($escuela)>0) : ?>
        <?php foreach ($e as $row_e) : ?>
            <div class="conteinar shadow m-4 form-control">
                <form class="row m-4 g-3" novalidate action="AgregarEscuela.php" method="post">
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-2">Nombre:</label>
                        <input type="text" value="<?php echo $row_e['nombre']; ?>" require class="form-control" name="Nombre">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label mb-2">Tel:</label>
                        <input type="text" value="<?php echo $row_e['tel']; ?>" require class="form-control" name="Tel">
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label">Correo:</label>
                        <input type="email" class="form-control" name="correo" value="<?php echo $row_e['email']; ?>">
                    </div>
                    <div class="my-3 col-12 col-md-4">
                        <label class="form-label mx-2 mb-2">Dirección:</label>
                        <input class="form-control" value="<?php echo $row_e['dirección']; ?>" type="text" require name="dirección">
                    </div>
                    <div class="my-3 col-12 col-md-4">
                        <label class="form-label mx-2 mb-2">responsable:</label>
                        <input class="form-control" type="text" value="<?php echo $row_e['responsable']; ?>" name="responsable">
                    </div>
                    <div class="d-flex justify-content-center m-3">
                        <a href="/proyectos/ConsejoEscolar Original/sub/ver_editar_escuelas.php" class="btn btn-danger mx-2">Cancelar</a>
                        <button type="submit" value="<?php echo $row_e['id']; ?>" name="id" class="btn btn-primary mx-2">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php endif; ?>
</body>

</html>