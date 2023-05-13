<?php
include './app/main.php';
include './app/Includes/header.php';

?>

<section class="d-flex flex-column m-0 p-3" id="histtickets">

    <div id="pageTitle">
        <h1>Boletos</h1>
        <h3>Pendientes</h3>
    </div>

    <div class="d-flex flex-row justify-content-around align-items-center border border-dark w-100">
        <div class="div-img"
            style="min-height: 150px;background-image: url(<?=WEB_URL?>/app/Storage/fimeno.jpg);margin-left: 20px;width: 95px">
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Pelicula:Pelicula A </p>
            <p class="p-0">Formato: 2D </p>
            <p class="p-0">Idioma:Esp</p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Dia: 28 Febrero </p>
            <p class="p-0">Hora: 11:10</p>
            <p class="p-0">Sala: 4</p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Asientos: H1,H2,H3,H4</p>
            <p class="p-0">Adulto: 2</p>
            <p class="p-0">Estudiante: 1</p>
            <p class="p-0">Niño: 1</p>
        </div>
        <div class="div-img"
            style="height: 100px;background-image: url(<?=WEB_URL?>/app/Storage/qrcode.png);width: 95px">
        </div>
    </div>

    <div class="d-flex flex-row justify-content-around align-items-center border border-dark w-100">
        <div class="div-img"
            style="min-height: 150px;background-image: url(<?=WEB_URL?>/app/Storage/fimeno.jpg);margin-left: 20px;width: 95px">
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Pelicula:Pelicula A </p>
            <p class="p-0">Formato: 2D </p>
            <p class="p-0">Idioma:Esp</p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Dia: 28 Febrero </p>
            <p class="p-0">Hora: 11:10</p>
            <p class="p-0">Sala: 4</p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Asientos: H1,H2,H3,H4</p>
            <p class="p-0">Adulto: 2</p>
            <p class="p-0">Estudiante: 1</p>
            <p class="p-0">Niño: 1</p>
        </div>
        <div class="div-img"
            style="height: 100px;background-image: url(<?=WEB_URL?>/app/Storage/qrcode.png);width: 95px">
        </div>
    </div>

    <div id="pageTitle">
        <h3>Pasados</h3>
    </div>
    <div class="d-flex flex-row justify-content-around align-items-center border border-dark w-100">
        <div class="div-img"
            style="min-height: 150px;background-image: url(<?=WEB_URL?>/app/Storage/fimeno.jpg);margin-left: 20px;width: 95px">
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Pelicula:Pelicula A </p>
            <p class="p-0">Formato: 2D </p>
            <p class="p-0">Idioma:Esp</p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Dia: 28 Febrero </p>
            <p class="p-0">Hora: 11:10</p>
            <p class="p-0">Sala: 4</p>
        </div>
        <div class="d-flex flex-column">
            <p class="p-0"> Asientos: H1,H2,H3,H4</p>
            <p class="p-0">Adulto: 2</p>
            <p class="p-0">Estudiante: 1</p>
            <p class="p-0">Niño: 1</p>
        </div>
        <div class="div-img"
            style="height: 100px;background-image: url(<?=WEB_URL?>/app/Storage/qrcode.png);width: 95px">
        </div>
    </div>

</section>


<?php
include './app/Includes/footer.php';
?>