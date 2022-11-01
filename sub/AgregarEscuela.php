<?php
include './db/conexion.php';
// FIXME - tendria que cambiarse para ser utilizado con ajax
    if(isset($_POST['Aregar'])){

        $sql= $conn->prepare('INSERT INTO `escuelas`(`nombre`, `dirección`, `email`, `responsable`,`tel`) VALUES (?, ?, ?, ?, ?)');
        
        $sql->bindParam(1,$_POST['Nombre']);
        $sql->bindParam(2,$_POST['dirección']);
        $sql->bindParam(3,$_POST['correo']);
        $sql->bindParam(4,$_POST['responsable']);
        $sql->bindParam(5,$_POST['Tel']);

        // verificacion para que no aya datos repetidos
        $escuela = $conn->prepare("SELECT * FROM escuelas where 1");
        $escuela->execute();
        $result_escuelas = $escuela->fetchAll();

        $e = null;
        
        if (is_countable($result_escuelas)) {
            if (count($result_escuelas) != 0) {
                $e = $result_escuelas;
            }
        }
       
        foreach ($e as $row_e) :
            if ($_POST['Nombre'] == $row_e['nombre']) {
                echo "<script>alert('El nombre ya fue ingresado')</script>";
                header('refresh:1;');
                return;
            }
            if ($_POST['Tel'] == $row_e['tel']) {
                echo "<script>alert('El Telefono ya fue utilizado')</script>";
                header('refresh:1;');
                return;
            }
            if ($_POST['correo'] == $row_e['email']){
                echo "<script>alert('El correo ya fue utilizado')</script>";
                header('refresh:0.5;');
                return;
            }
        endforeach;

        if ($sql->execute()) {
            echo '<script>alaert("Se creo la escuela correctamente");</script>';
            $message = 'Se creo la escuela correctamente';
            header('Location:../index.php');
        }  
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Escuela</title>
</head>

<body>
    <?php include './div/heder.php'; ?>
    <div class="conteinar shadow m-4 form-control">
        <form class="row m-4 g-3" novalidate action="AgregarEscuela.php" method="post">
            <div class="col-12 col-md-4">
                <label class="form-label mb-2">Nombre:</label>
                <input type="text" placeholder="Nombre de la escuela" require class="form-control" name="Nombre">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label mb-2">Tel:</label>
                <input type="text" placeholder="Tel" require class="form-control" name="Tel">
            </div>
            <div class="col-12 col-md-4">
                <label class="form-label">Correo:</label>
                <input type="email" class="form-control" name="correo" placeholder="ejemplo@gmail.com">
            </div>
            <div class="my-3 col-12 col-md-4">
                <label class="form-label mx-2 mb-2">Dirección:</label>
                <input class="form-control" type="text" require placeholder="Dirección" name="dirección">
            </div>
            <div class="my-3 col-12 col-md-4">
                <label class="form-label mx-2 mb-2">responsable:</label>
                <input class="form-control" type="text" placeholder="Responsable" name="responsable">
            </div>
            <div class="d-flex justify-content-center my-4">
                <input type="submit" class="btn btn-primary" name="Aregar" value="Aregar">
            </div>
        </form>
    </div>
</body>

</html>