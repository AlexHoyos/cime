<?php

use CIME\Filters\SessionFilter;
use CIME\Models\AsientoReservado;
use CIME\Models\Boleto;
use CIME\Models\Usuario;

include './app/main.php';

SessionFilter::existsUserSession();

$user = SessionFilter::getUserBySession();

if($user instanceof Usuario){
    include './app/Includes/header.php';
    $boletos = Boleto::getBoletosByUserId($user->getId());
?>

<section class="d-flex flex-column m-0 p-3" id="histtickets">

    <div id="pageTitle">
        <h1>Boletos</h1>
        <h3>Pendientes</h3>
    </div>
    <?php
    foreach($boletos as $key => $boleto){
        $funcion = $boleto->getFuncionInstance();
        $fecha_funcion = date('Y-m-d', strtotime($funcion->getFecha()));
        if($fecha_funcion >= $fechaHoy->format('Y-m-d')){
            $asientosReservados = AsientoReservado::getAsientosFromBoletoId($boleto->getId());
            $asientos = [];
            foreach($asientosReservados as $asientoReservado){
                $asientos[] = $asientoReservado->getNombre();
            }
            $asientos = implode(", ", $asientos);

    ?>
    <div class="d-flex flex-row justify-content-around align-items-center border border-dark w-100 my-2">
        <div class="div-img"
            style="min-height: 150px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$funcion->getPelicula()->getPortada()?>);margin-left: 20px;width: 95px">
        </div>
        <div class="d-flex flex-column">
            <p class="p-0">Pelicula: <?=$funcion->getPelicula()->getTitulo()?></p>
            <p class="p-0">Formato: <?=$funcion->getFormato()->getNombre()?> </p>
            <p class="p-0">Idioma: <?=strtoupper($funcion->getIdioma()->getNombre())?> <?=($funcion->getSubtitulos() != null)?" SUB ".strtoupper($funcion->getSubtitulos()->getNombre()):""?> </p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Dia: <?=$fecha_funcion?> </p>
            <p class="p-0">Hora: <?=$funcion->getHora()?></p>
            <p class="p-0">Sala: <?=$funcion->getSala()->getNombre()?></p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Asientos: <?=$asientos?></p>
            <p class="p-0">Adultos: <?=$boleto->getNumAdultos()?></p>
            <p class="p-0">Estudiantes: <?=$boleto->getNumAdols()?></p>
            <p class="p-0">Niños: <?=$boleto->getNumNinos()?></p>
        </div>
        <div class="div-img" onclick="location.href='<?=WEB_URL?>/boleto.php?id=<?=$boleto->getId()?>&correo=<?=$boleto->getCorreo()?>'"
            style="height: 100px;background-image: url(<?=WEB_URL?>/app/Storage/qrcode.png);width: 95px; cursor:pointer;">
        </div>
    </div>
    <?php unset($boletos[$key]); } } ?>

    <div id="pageTitle">
        <h3>Pasados</h3>
    </div>
    <?php
    foreach($boletos as $key => $boleto){

        $funcion = $boleto->getFuncionInstance();
        $fecha_funcion = date('Y-m-d', strtotime($funcion->getFecha()));
        $asientosReservados = AsientoReservado::getAsientosFromBoletoId($boleto->getId());
        $asientos = [];
        foreach($asientosReservados as $asientoReservado){
            $asientos[] = $asientoReservado->getNombre();
        }
        $asientos = implode(", ", $asientos);

    ?>
     <div class="d-flex flex-row justify-content-around align-items-center border border-dark w-100 my-2">
        <div class="div-img"
            style="min-height: 150px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$funcion->getPelicula()->getPortada()?>);margin-left: 20px;width: 95px">
        </div>
        <div class="d-flex flex-column">
            <p class="p-0">Pelicula: <?=$funcion->getPelicula()->getTitulo()?></p>
            <p class="p-0">Formato: <?=$funcion->getFormato()->getNombre()?> </p>
            <p class="p-0">Idioma: <?=strtoupper($funcion->getIdioma()->getNombre())?> <?=($funcion->getSubtitulos() != null)?" SUB ".strtoupper($funcion->getSubtitulos()->getNombre()):""?> </p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Dia: <?=$fecha_funcion?> </p>
            <p class="p-0">Hora: <?=$funcion->getHora()?></p>
            <p class="p-0">Sala: <?=$funcion->getSala()->getNombre()?></p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Asientos: <?=$asientos?></p>
            <p class="p-0">Adultos: <?=$boleto->getNumAdultos()?></p>
            <p class="p-0">Estudiantes: <?=$boleto->getNumAdols()?></p>
            <p class="p-0">Niños: <?=$boleto->getNumNinos()?></p>
        </div>
        <div class="div-img" onclick="location.href='<?=WEB_URL?>/boleto.php?id=<?=$boleto->getId()?>&correo=<?=$boleto->getCorreo()?>'"
            style="height: 100px;background-image: url(<?=WEB_URL?>/app/Storage/qrcode.png);width: 95px; cursor:pointer;">
        </div>
    </div>
        <?php } ?>
</section>


<?php
include './app/Includes/footer.php';
}
?>