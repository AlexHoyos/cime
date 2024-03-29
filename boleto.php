<?php

use chillerlan\QRCode\QRCode;
use CIME\Filters\SessionFilter;
use CIME\Models\AsientoReservado;
use CIME\Models\Boleto;
use CIME\Models\Usuario;

    include './app/main.php';
    include './app/Includes/header.php';

    $boletoID = 0;
    $correo = "";

    $isAdmin = false;
    $user = SessionFilter::getUserBySession();

    if(isset($_GET["id"]))
        $boletoID = intval($_GET["id"]);

    if(isset($_GET["correo"]))
        $correo = $_GET["correo"];

    if($user instanceof Usuario)
        if($user->getRol()->getNombre() != 'usr')
            $isAdmin = true;

    $boleto = Boleto::getById($boletoID);

    if($boleto->getCorreo() == $correo || $isAdmin){
        $funcion = $boleto->getFuncionInstance();
        $pelicula = $funcion->getPelicula();
        $sala = $funcion->getSala();
        $asientosReservados = AsientoReservado::getAsientosFromBoletoId($boleto->getId());
        $asientos = [];
        foreach($asientosReservados as $asientoReservado){
            $asientos[] = $asientoReservado->getNombre();
        }
        $asientos = implode(", ", $asientos);

        $adultos = $boleto->getNumAdultos();
        $adols = $boleto->getNumAdols();
        $ninos = $boleto->getNumNinos();
        $subtotal = floatval($funcion->getPrecioAdulto()*$adultos)+floatval($funcion->getPrecioAdol()*$adols)+floatval($funcion->getPrecioNino()*$ninos);
        $qrcode = (new QRCode($QRoptions))->render($boleto->getId());

?>

<section class="row m-0 p-0" id="aboutUs">
    <div class="col-11" id="pageTitle">
        <h1>Boleto</h1>
    </div>
    <div class="container">
        <div class="row p-3">
            <div class="col-12 col-md-6">
                <div class="row">
                    <div class="col-md-6 col-lg-4 div-img" style="min-height: 300px; background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$pelicula->getPortada()?>)"></div>
                    <div class="col-md-6 col-lg-8">
                        <h2>Película: <?=$pelicula->getTitulo()?></h2>
                        <p>Formato: <?=$funcion->getFormato()->getNombre()?></p>
                        <p>Idioma: <?=strtoupper($funcion->getIdioma()->getNombre())?> <?=($funcion->getSubtitulos() != null)?" SUB ".strtoupper($funcion->getSubtitulos()->getNombre()):""?></p>
                        <p>Día: <?=$funcion->getFecha()?></p>
                        <p>Hora: <?=$funcion->getHora()?></p>
                        <p>Sala: <?=$sala->getNombre()?></p>
                        <p>Asientos: <?=$asientos?></p>
                    </div>
                </div>
                <h5>Boletos</h5>
                <p>Adultos: <?=$adultos?> x $<?=number_format($funcion->getPrecioAdulto(),2)?></p>
                <p>Adolescentes: <?=$adols?> x $<?=number_format($funcion->getPrecioAdol(),2)?></p>
                <p>Niños: <?=$ninos?> x $<?=number_format($funcion->getPrecioNino(),2)?></p>
                <p>Total pagado: $<?=number_format($subtotal, 2)?></p>
            </div>
            
            <div class="col-12 col-md-2 d-flex align-items-start justify-content-center mt-3" style="margin-top: -30px;">
                <div class="boletos-info text-center">
                    <div class="boletos d-flex flex-row flex-md-column">
                        <?php if($adultos > 0){ ?>
                        <div class="boletos-item">
                            <i class="fa-solid fa-user"></i>
                            <p>X<?=$adultos?></p>
                        </div>
                        <?php } ?>
                        <?php if($adols > 0){ ?>
                        <div class="boletos-item">
                            <i class="fa-solid fa-user-graduate"></i>
                            <p>X<?=$adols?></p>
                        </div>
                        <?php } ?>
                        <?php if($ninos > 0){ ?>
                        <div class="boletos-item">
                            <i class="fa-solid fa-child"></i>
                            <p>X<?=$ninos?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="row justify-content-end">
                    <div class="col-lg-6 text-right">
                        <img src="<?=$qrcode?>" alt="Código QR" class="img-fluid mb-3">
                        <p class="codigo-texto">Código: <?=$boleto->getId()?></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <p class="disfrute-mensaje"><h1>¡Disfrute su función!<h1></p>
            </div>
        </div>
    </div>
</section>

<?php
    }
    include './app/Includes/footer.php';
?>
