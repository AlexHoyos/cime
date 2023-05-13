<?php

use CIME\Models\Funcion;
use CIME\Models\Pelicula;

include '../app/main.php';
include '../app/Includes/Admin/Dashboard.php';

$fecha = $fecha = date('Y-m-d');
$peliculasEnCartelera = Pelicula::getPeliculasInCartelera($fecha);

$peli = 0;

if(isset($_GET["pelicula"]))
    $peli = intval($_GET["pelicula"]);

$pelicula = Pelicula::getById($peli); ?>

<section class="row m-0 p-0 py-1 w-100" id="cartelera">     

<?php if($pelicula == null){ 
    foreach($peliculasEnCartelera as $pelicula){?>
        <div class="col">
            <div class="div-img m-1"
                    style="height: 350px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$pelicula->portada?>);width: 250px;margin-left: 20px;cursor:pointer;"
                    onclick="insertParam('pelicula', <?=$pelicula->id?>)">
                </div>
        </div>
    <?php
        }

    } else {
        $grupos = Funcion::getFuncionesPelicula($pelicula->getId(), 0, 0, 0, $fecha, true);
    ?>

        <div class="col-12">
            <h1><?=$pelicula->getTitulo()?></h1>
        </div>
        <div class="col-12">
            <a href="cartelera.php" class="btn btn-dark py-4 w-100">Regresar</a>
        </div>
        <?php foreach($grupos as $grupoName => $funciones){ ?>
            <div class="col-12 d-flex flex-column">
                <h4><b><?= Funcion::getDescriptionGrupoFunciones($grupoName)?></b></h4>
                <div class="d-flex flex-row">
                    <?php foreach($funciones as $funcion){ ?>
                        <a href="reservar.php?funcion=<?=$funcion->id?>" class="btn btn-secondary p-5"><?=$funcion->hora?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    <?php }
    include '../app/Includes/Admin/Footer.php';
    ?>
    </section>
    <script src="../assets/js/utils.cime.js"></script>
</body>
</html>