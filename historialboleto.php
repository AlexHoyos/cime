<?php
include './app/main.php';
include './app/Includes/header.php';

?>

<section class="d-flex flex-column" id="histtickets">

    <div id="pageTitle">
        <h1>Boletos</h1>
        <h3>Pendientes</h3>
    </div>

    <div class="d-flex flex-row mb-2 histboletos1 w-100">
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 90px;background-image: url(fimeno.jpg);margin-left: 10px;width: 120px">
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes1">
            <p class="p-0"> Pelicula:Pelicula A </p>
            <p class="p-0">Formato: 2D </p>
            <p class="p-0">Idioma:Esp</p>
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes2">
            <p class="p-0"> Dia: 28 Febrero </p>
            <p class="p-0">Hora: 11:10</p>
            <p class="p-0">Sala: 4</p>
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes3">
            <p class="p-0"> Asientos: H1,H2,H3,H4</p>
            <p class="p-0">Adulto: 2</p>
            <p class="p-0">Estudiante: 1</p>
            <p class="p-0">Niño: 1</p>
        </div>
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 120px;background-image: url(qrcode.png);margin-left: 400px;width: 150px;margin-top: 10px">
        </div>
    </div>

    <div class="d-flex flex-row histboletos2 w-100">
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 150px;background-image: url(fimeno.jpg);margin-left: 10px;width: 120px">
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes1">
            <p class="p-0"> Pelicula: Pelicula B </p>
            <p class="p-0">Formato: 2D </p>
            <p class="p-0">Idioma:Esp</p>
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes2">
            <p class="p-0"> Dia: 12 Marzo </p>
            <p class="p-0">Hora: 16:30</p>
            <p class="p-0">Sala: 1</p>
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes3">
            <p class="p-0"> Asientos: G4,G5</p>
            <p class="p-0">Adulto: 2</p>
        </div>
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 120px;background-image: url(qrcode.png);margin-left: 470px;width: 150px;margin-top: 5px">
        </div>
    </div>

    <div id="pageTitle">
        <h3>Pasados</h3>
    </div>
    <div class="d-flex flex-row histboletos3 w-100">
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 150px;background-image: url(fimeno.jpg);margin-left: 10px;width: 120px">
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes1">
            <p class="p-0"> Pelicula: Pelicula C </p>
            <p class="p-0">Formato: 2D </p>
            <p class="p-0">Idioma:Esp</p>
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes2">
            <p class="p-0"> Dia: 5 Enero </p>
            <p class="p-0">Hora: 19:00</p>
            <p class="p-0">Sala: 2</p>
        </div>
        <div class="d-flex flex-column  aling-items-center justify-content pendientes3">
            <p class="p-0"> Asientos: H3,H4</p>
            <p class="p-0">Adulto: 2</p>
        </div>
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 120px;background-image: url(qrcode.png);margin-left: 470px;width: 150px;margin-top: 5px">
        </div>
    </div>

</section>


<?php
include './app/Includes/footer.php';
?>