<?php

use CIME\Filters\CRUDPageFilter;
use CIME\Models\Pelicula;

include './app/main.php';

$busqueda = "";
if(isset($_GET["search"])){
    $busqueda = preg_replace("/[^A-Za-z0-9 ]/", '', $_GET["search"]);
}

if($busqueda != ""){
    $page = CRUDPageFilter::getPageNumber();
    $resultados = Pelicula::getAll([], "titulo LIKE '%{$busqueda}%' OR sinopsis LIKE '%{$busqueda}%'", "ORDER BY id DESC");
    $peliculas = $resultados->page($page);
    $availablePages = $resultados->totalPages();
    $nextPageAdd = '&search='.$busqueda;

    include './app/Includes/header.php';

?>

<section class="row m-0 p-0" id="SearchMovie">
    <div class="col-11" id="pageTitle">
        <h1>Busqueda</h1>
        <h5>Resultados para "<?=$busqueda?>"</h5>
    </div>
    <article class="row col-12 px-4">
        
        <?php
            foreach($peliculas as $pelicula){
                $pelicula = Pelicula::transformRow((object) $pelicula);
        ?>
        <div class="col-12 d-flex flex-row">
            <div class="d-flex flex-column">
                <div class="col-12 col-md-6 col-lg-4 div-img m-1"
                    style="min-height: 350px;background-image: url(/app/Storage/peliculas/<?=$pelicula->getPortada()?>);width: 250px;margin-left: 20px;cursor:pointer;">
                </div>
                <div>
                    <div class="login-icon" style="font-size:18px">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <h4><?=$pelicula->getTitulo()?>
                    <span class="badge bg-dark text-light"><?=$pelicula->getClasificacionInstance()->getNombre()?></span>
                    <span class="badge bg-dark text-light"><?=$pelicula->getDuracion()?> min</span>
                </h4>
                <div class="mx-1" style="max-width:500px">
                    <p class="col-12 col-md-6 col-lg-8 text-justify">
                        <?=$pelicula->getSinopsis()?>
                    </p>
                </div>
            </div>
        </div>
        <hr>
        <?php } ?>

    </article>
    <?php require('app/Includes/PageNavigation.php'); ?>
</section>
<?php
} else {
    header("Location: /");
}

include './app/Includes/footer.php';

?>