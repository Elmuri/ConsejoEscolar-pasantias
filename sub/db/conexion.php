<?php
try {
    $conn = new PDO('mysql:host=localhost;dbname=consejo_escolar_db', 'root', '');
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);

} catch (PDOException $erorr) {
    echo $error->getMessage();
    die();
}
?>