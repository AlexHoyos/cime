<?php

use CIME\Models\Pelicula;

    include './app/main.php';

    $pelicula = null;
    if(isset($_GET["id"])){
        $peliId = intval($_GET["id"]);
        $pelicula = Pelicula::getById($peliId);
    }

    if($pelicula instanceof Pelicula){

        include './app/Includes/header.php';
    
?>

<section class="d-flex flex-column" id="movie">

        <div id="pageTitle">
            <h1><?=$pelicula->getTitulo()?></h1>
        </div>

        <div class="d-flex flex-row w-100">

            <div class="m-0 ps-3" style="width:250px">
                <div class="col-12 col-md-6 col-lg-4 div-img w-100"
                    style="min-height: 350px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$pelicula->getPortada()?>);">
                </div>
                <!--
                <div class="d-flex flex-row justify-content-center my-2">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div> -->
            </div>

            <div class="d-flex flex-column">
                <div class="col-2 infopelicula">
                    <h5 class="clasificacion"><?=$pelicula->getClasificacionInstance()->getNombre()?></h5>
                    <h5 class="duracion"><?=$pelicula->getDuracion()?> min</h5>
                </div>

                <div class="px-3 m-0">
                    <h3>Sinopsis</h3>
                    <p class="col-12 text-justify">
                    <?=$pelicula->getSinopsis()?>
                    </p>
                </div>

                <div class="px-3">
                    <b>Próximas funciones:</b>
                    <br>
                    <?php
                    $funciones = $pelicula->getProxFunciones();
                    foreach($funciones as $funcion){
                        $fecha = $funcion->fecha;
                    ?>

                    <a href="<?=WEB_URL?>/cartelera.php?peli=<?=$pelicula->getId()?>&fecha=<?=$fecha?>" class="btn btn-secondary p-3">
                        <h5><?=$fecha?></h5>
                    </a>

                    <?php } ?>
                    <?php 
                        if(count($funciones) <= 0){
                    ?>
                    <p>No se encontraron proximas funciones:(</p>
                    <?php } ?>
                </div>

            </div>

        </div>


        

        <div class="col-11" id="pageTitle">
          <!--  <h1>Reseñas</h1> -->
        </div>

        <?php
        $resenas = [];
        foreach($resenas as $resena){
        ?>
            <div class="col-6 reseña">
                <h5>Juan Perez</h5>
                <div class="calificacion2">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                </div>
                <p class="col-12 text-justify">
                La pelicula de Soy Fimeño estuvo increible, además de la experiencia en la sala fue muy satisfactoria
                fue un 10/10, super recomendado.
                </p>
            </div>
        <?php } ?>

</section>

<?php
    } else {
        header("Location: /");
    }
    include './app/Includes/footer.php';
?>