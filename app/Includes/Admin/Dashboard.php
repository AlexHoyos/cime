<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= WEB_URL ?>/assets/css/Admin.css">
    <link rel="stylesheet" href="<?=WEB_URL?>/assets/css/global.css">
    <title>Admin Panel</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg p-0" id="headerNav">
            <div class="container-fluid">
                <button class="navbar-toggler ms-auto mb-lg-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars text-light"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    
                    <ul class="nav flex-colum">
                        <img class="LOGO" src="<?= WEB_URL ?>/app/Storage/LOGO.png">
                        <li class="menu">Empleado</li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="<?= WEB_URL ?>">Cartelera</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Escaner</a>
                        </li>
                        <li class="menu">Reportes Personales</li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reportes ventas</a>
                        </li>
                        <li class="menu">Admin</li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_URL . '/Pelicula.php' ?>">Peliculas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_URL . '/Clasificacion.php' ?>">Clasificaciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_URL . '/Sala.php' ?>">Salas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_URL . '/Funcion.php' ?>">Funciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_URL . '/Boleto.php' ?>">Boletos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= WEB_URL . '/Usuario.php' ?>">Usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Empleados</a>
                        </li>
                        <li class="menu">Reporte General</li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Reporte general ventas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Estadisticas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Salir</a>
                        </li>
                    </ul>