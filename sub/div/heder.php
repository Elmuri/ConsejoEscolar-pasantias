<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINK - bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- LINK - dropzone javascript and css -->
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    <!-- LINK - favicons -->
    <link rel="icon" type="image/x-icon" href="/src/img/logoeest4_sin-fondo.ico">
    <!-- LINK - toastify -->
    <!-- <link rel="stylesheet" href="/src/style/ReactToastify.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
</head>

<body>
    <!-- NOTE - navbar (Por pra aclarar si se cambia la carpeta de destino ConsejoEscolar-pasantias hay que cambiar las url absolutas del navbar) -->
    <nav class="navbar navbar-expand-lg bg-light shadow p-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="/consejoEscolar-Pasantias/index.php">Consejo Escolar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                    <?php if (isset($_SESSION['usuario']) && $_SERVER['REQUEST_URI'] != "/consejoEscolar-Pasantias/index.php") : ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/consejoEscolar-Pasantias/index.php">Home</a>
                        </li>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['usuario'])) : ?>
                        <?php if ($_SERVER['REQUEST_URI'] != "/consejoEscolar-Pasantias/sub/CrearPedido.php") : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/consejoEscolar-Pasantias/sub/CrearPedido.php">Nuevo pedido</a>
                            </li>
                        <?php endif; ?>
                        <?php if ($_SERVER['REQUEST_URI'] != "/consejoEscolar-Pasantias/sub/AgregarEscuela.php") : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/consejoEscolar-Pasantias/sub/AgregarEscuela.php">Agregar escuela</a>
                            </li>
                        <?php endif; ?>
                        <?php
                        if ($_SERVER['REQUEST_URI'] != '/consejoEscolar-Pasantias/sub/ver_editar_escuelas.php') : ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="/consejoEscolar-Pasantias/sub/ver_editar_escuelas.php">Ver | editar escuelas</a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php if (!isset($_SESSION['usuario'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/consejoEscolar-Pasantias/sub/login.php">login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/consejoEscolar-Pasantias/sub/registro.php">Registro</a>
                        </li>
                    <?php endif; ?>
                    <div class="d-flex justify-content-end me-auto">
                        <?php if (isset($_SESSION['usuario'])) : ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                    <?php echo $_SESSION['usuario'] ?></a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="/consejoEscolar-Pasantias/sub/exit.php">Cerrar Sesión</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                    </div>
                </ul>
                <!-- FIXME - Desarollar un buscador en el menu para buscar los pedidos -->
                <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
            </div>
        </div>
    </nav>

    <!-- LINK - script -->
    <!-- LINK - script bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!-- LINK - script dropzone -->
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    <!-- LINK - script iconon -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <!-- LINK - script toastify notficaciones -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>    
</body>

</html>