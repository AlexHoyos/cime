<?php
include './app/main.php';
include './app/Includes/header.php';

?>

<section class="d-flex flex-column" id="histtickets">

    <div id="pageTitle">
        <h1>Boletos</h1>
        <h3>Pendientes</h3>
    </div>

    <div class="col-6 histboletos1">
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 100px;background-image: url(fimeno.jpg);margin-left: 20px;width: 95px">
        </div>
        <div class="col-4 pendientes">
            <p class="col-8 col-lg-8 px-4  text-justify" style="margin-left: 100px;margin-top: -100px"> Pelicula:
                Pelicula A Formato: 2D Idioma:Esp</p>
            <p class="col-12 col-lg-8 px-4 text-justify" style="margin-left: 220px;margin-top: -115px"> Dia: 28
                Febrero Hora: 11:10 Sala: 4</p>
            <p class="col-10  col-lg-8 px-4 text-justify" style="margin-left: 350px;margin-top: -115px"> Asientos:
                H1,H2,H3,H4 Adulto: 2 Estudiante: 1 Niño: 1</p>
        </div>
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 100px;background-image: url(qrcode.png);margin-left: 550px;width: 95px;margin-top: -125px">
        </div>
    </div>

    <div class="col-6 histboletos2">
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 100px;background-image: url(fimeno.jpg);margin-left: 20px;width: 95px;margin-top: 50px">
        </div>
        <div class="col-4 pendientes">
            <p class="col-8 col-lg-8 px-4  text-justify" style="margin-left: 100px;margin-top: -100px"> Pelicula:
                Pelicula B Formato: 2D Idioma:Esp</p>
            <p class="col-12 col-lg-8 px-4 text-justify" style="margin-left: 220px;margin-top: -115px"> Dia: 12
                Marzo Hora: 16:30 Sala: 1</p>
            <p class="col-10  col-lg-8 px-4 text-justify" style="margin-left: 350px;margin-top: -90px"> Asientos:
                G4,G5 Adulto: 2</p>
        </div>
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 100px;background-image: url(qrcode.png);margin-left: 550px;width: 95px;margin-top: -80px">
        </div>
    </div>

    <div id="pageTitle">
        <h3>Pasados</h3>
    </div>

    <div class="col-6 histboletos3">
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 100px;background-image: url(fimeno.jpg);margin-left: 20px;width: 95px;margin-top: 5px">
        </div>
        <div class="col-4 pasados">
            <p class="col-8 col-lg-8 px-4  text-justify" style="margin-left: 100px;margin-top: -110px"> Pelicula:
                Pelicula C Formato: 2D Idioma:Esp</p>
            <p class="col-12 col-lg-8 px-4 text-justify" style="margin-left: 220px;margin-top: -115px"> Dia: 05
                Enero Hora: 19:00 Sala: 2</p>
            <p class="col-10  col-lg-8 px-4 text-justify" style="margin-left: 350px;margin-top: -90px"> Asientos:
                H3,H4 Adulto: 2</p>
        </div>
        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 100px;background-image: url(qrcode.png);margin-left: 550px;width: 95px;margin-top: -60px;margin-bottom: 10px">
        </div>
    </div>

</section>

<?php
include './app/Includes/footer.php';
?>