<?php

use CIME\Models\Formato;
use CIME\Models\Funcion;
use CIME\Models\Idioma;
use CIME\Models\Pelicula;

    include './app/main.php';
    include './app/Includes/header.php';

    $fecha = date('Y-m-d');
    if(isset($_GET["fecha"]))
        $fecha = $_GET["fecha"];

    $peliId = 0;
    if(isset($_GET["peli"]))
        $peliId = intval($_GET["peli"]);

    $formatoID = 0;
    if(isset($_GET["formato"]))
        $formatoID = intval($_GET["formato"]);

    $idiomaID = 0;
    if(isset($_GET["idioma"]))
        $idiomaID = intval($_GET["idioma"]);

    $subID = 0;
    if(isset($_GET["sub"]))
        $subID = intval($_GET["sub"]);

    $peliculasEnCartelera = Pelicula::getPeliculasInCartelera($fecha);

?>

<section class="row m-0 p-0 py-1" id="cartelera">
    <div class="col-12" id="pageTitle">
        <h1>Cartelera</h1>
    </div>

    <div class="col-12 col-md-4 col-lg-2 d-flex flex-column" style="min-height:200px">

            <a href="cartelera.php" class="btn btn-link">Borrar filtros</a>
            <div class="fecha d-flex flex-column">
                <b>Seleccione una fecha</b>
                <input type="date" name="" id="" class="form-control" value="<?=$fecha?>" onchange="insertParam('fecha', this.value)">
            </div>

            <div class="formato d-flex flex-column">
                <b>Formatos</b>
                <div class="d-flex">
                    <?php
                    $formatos = Formato::getAll()->showAll();
                    foreach($formatos as $formato){
                        $formato = (object) $formato;
                    ?>
                        <label for="fomato-<?=$formato->id?>"><?=$formato->nombre?></label>
                        <input type="radio" class="mx-1" name="formato" id="fomato-<?=$formato->id?>" value="<?=$formato->id?>" <?=($formatoID == $formato->id) ? "checked":""?>
                            onchange="insertParam('formato', document.querySelector('input[name=formato]:checked').value)">
                    <?php } ?>
                </div>
            </div>

            <div class="formato d-flex flex-column">
                <b>Idiomas</b>
                <div class="d-flex">
                    <?php
                    $idiomas = Idioma::getAll()->showAll();
                    foreach($idiomas as $idioma){
                        $idioma = (object) $idioma;
                    ?>
                        <label for="idioma-<?=$idioma->id?>"><?=$idioma->nombre?></label>
                        <input type="radio" class="mx-1" name="idioma" id="idioma-<?=$idioma->id?>" value="<?=$idioma->id?>" <?=($idiomaID == $idioma->id) ? "checked":""?>
                            onchange="insertParam('idioma', document.querySelector('input[name=idioma]:checked').value)">
                    <?php } ?>
                </div>
            </div>

            <div class="formato d-flex flex-column">
                <b>Subtitulos</b>
                <div class="d-flex">
                    <?php
                    $idiomas = Idioma::getAll()->showAll();
                    foreach($idiomas as $idioma){
                        $idioma = (object) $idioma;
                    ?>
                        <label for="sub-<?=$idioma->id?>"><?=$idioma->nombre?></label>
                        <input type="radio" class="mx-1" name="sub" id="sub-<?=$idioma->id?>" value="<?=$idioma->id?>" <?=($subID == $idioma->id) ? "checked":""?>
                            onchange="insertParam('sub', document.querySelector('input[name=sub]:checked').value)">
                    <?php } ?>
                </div>
            </div>

    </div>

    <div class="col-12 col-md-8 col-lg-10 row m-0 p-1">
            
            <?php
                foreach($peliculasEnCartelera as $pelicula){
                    $grupos = Funcion::getFuncionesPelicula($pelicula->id, $formatoID, $idiomaID, $subID, $fecha, true);
                    if(count($grupos) > 0){
            ?>

            <div class="col-12 row">
                <div class="col-6 col-lg-4 div-img m-1"
                        style="min-height: 350px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$pelicula->portada?>);width: 250px;margin-left: 20px;cursor:pointer;"
                        onclick="">
                    </div>
                <div class="col-6 col-lg-8 d-flex flex-column">
                    <h3><?=$pelicula->titulo?></h3>
                    <?php
                        
                        foreach($grupos as $grupoName => $funciones){ ?>

                        <p><b><?= Funcion::getDescriptionGrupoFunciones($grupoName)?></b></p>
                        <div class="funciones">
                            <?php
                                foreach($funciones as $funcion){
                            ?>
                                <button class="btn btn-secondary"><?=$funcion->hora?></button>
                            <?php } ?>
                        </div>
                        <br>
                    <?php } ?>
                </div>
            </div>
            <?php
                } }
            ?>
    </div>

</section>

<script src="/assets/js/utils.cime.js"></script>

<?php
    include './app/Includes/footer.php';

?>