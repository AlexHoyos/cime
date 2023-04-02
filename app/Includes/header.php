<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?=WEB_URL?>/assets/css/global.css">
    <title>CIME</title>
</head>
<body>
    <header>
        <div class="d-flex align-items-center justify-content-end justify-content-md-center p-3" id="headerAbove">
            <img class="position-absolute" style="left:0;" src="<?= WEB_URL ?>/app/Storage/LOGO.png">
            <form action="#" role="search" class=" d-flex align-items-center justify-content-center" >
                <input type="text" class="buscar px-2" placeholder="Buscar pelicula...">
                <button type="button" class="btnbuscar">Buscar</button>
            </form>
        </div>
        <nav class="navbar navbar-expand-lg p-0" id="headerNav">
            <div class="container-fluid">
                <button class="navbar-toggler ms-auto mb-lg-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa-solid fa-bars text-light"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Cartelera</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Proximamente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=WEB_URL.'/nosotros.php'?>">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=WEB_URL.'/contacto.php'?>">Contacto</a>
                    </li>

                </ul>
                <ul class="navbar-nav ms-md-auto">
                    <li class="nav-item">
                        <a class="nav-link align-self-right" href="#">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Registro</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    </header>

