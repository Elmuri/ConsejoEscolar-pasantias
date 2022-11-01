<?php
include 'db/conexion.php';
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
    <title>Ver|editar escuelas</title>
</head>
<body>
    <?php include 'div/heder.php'; ?>
    <div class="container my-4">
        <?php if(isset($e)) : ?>
        <?php foreach ($e as $row_e) : ?>
        <details class="card shadow p-4 my-1">
                <summary>click para ver más<h4><?php echo $row_e['nombre']; ?></h4></summary>
                <div class="text-center">
                    <p>Responsable: <?php echo $row_e['responsable']; ?></p>
                    <p>Dirección: <?php echo $row_e['dirección']; ?></p>
                    <p>Email | correo: <?php echo $row_e['email']; ?></p>
                    <p>Telefono: <?php echo $row_e['tel']; ?></p>
                </div>
                <?php if(isset($_SESSION['usuario'])): ?>
                <form class="d-flex justify-content-center m-3" action="EditarEscuela.php" method="GET">
                    <button type="submit" value="<?php echo $row_e['id']; ?>" name="delete" class="btn btn-danger mx-2">Eliminar escuela</button>
                    <button type="submit" value="<?php echo $row_e['id']; ?>" name="id" class="btn btn-primary mx-2">Editar escuela</button>
                </form>
                <?php endif; ?>
            </details>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>