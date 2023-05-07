<?php

use CIME\Models\Pelicula;

    include './app/main.php';
    include './app/Includes/header.php';
?>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $peliculasCarousel = Pelicula::getPeliculasCarousel();
    $state = "active";
    foreach($peliculasCarousel as $peli){
        
    ?>
    <div class="carousel-item <?=$state?>">
        <div class="img-carousel" style="background-image: url(app/Storage/peliculas/<?=$peli->wallpaper?>)"></div>
        <div class="carousel-caption d-none d-md-block">
            <h4><?=$peli->titulo?></h4>
        </div>
    </div>
    <?php if($state == "active") $state = ""; } ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<section class="row m-0 p-0 py-1" id="pelisEnCartelera">
    <div class="col-12" id="pageTitle">
        <h1>Peliculas en cartelera</h1>
    </div>
    <div class="col-12 row m-0 p-0">
    <?php
    $peliculasEnCartelera = Pelicula::getPeliculasInCartelera();
    foreach($peliculasEnCartelera as $peli){
    ?>
    <div class="col-12 col-md-6 col-lg-4 div-img m-1"
            style="min-height: 350px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$peli->portada?>);width: 250px;margin-left: 20px;cursor:pointer;">
        </div>
    <?php } ?>
    </div>
</section>

<?php
    include './app/Includes/footer.php';

?>