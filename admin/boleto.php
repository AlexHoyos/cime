<?php

use chillerlan\QRCode\QRCode;
use CIME\Filters\SessionFilter;
use CIME\Models\AsientoReservado;
use CIME\Models\Boleto;
use CIME\Models\Usuario;

    include '../app/main.php';

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

    if($isAdmin && $boleto instanceof Boleto){

        include '../app/Includes/Admin/Dashboard.php';

        $funcion = $boleto->getFuncionInstance();
        $pelicula = $funcion->getPelicula();

        $fecha_funcion = date('Y-m-d', strtotime($funcion->getFecha()));
        if($boleto->getEstado() == 1){
            if($fecha_funcion < $fechaHoy->format('Y-m-d')){
                // Lo establecemos como caduco
                $boleto->setEstado(4);
                $boleto->update();
            } else if($fecha_funcion == $fechaHoy->format('Y-m-d') && isset($_GET["escaner"])){

                $boleto->setEstado(3);
                $boleto->update();
            }
        }

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

<section class="row m-0 p-0 w-100" id="boleto">
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
                    <div class="col-12 d-flex justify-content-end mx-3">
                        <button class="btn btn-secondary" onclick="imprimirElemento( document.getElementById('boleto') )">Imprimir</button>
                    </div>
                    <div class="col-lg-6 text-center">
                        <img src="<?=$qrcode?>" alt="Código QR" class="img-fluid mb-3">
                        <p class="codigo-texto">Código: <?=$boleto->getId()?></p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <p class="disfrute-mensaje">
                    <?php
                        if($boleto->getEstado() == 1 && $fecha_funcion == $fechaHoy->format('Y-m-d')){
                    ?>
                    <h1> <span class="badge bg-success text-light">BOLETO ACEPTABLE</span> <h1>
                    <?php } else if($boleto->getEstado() == 1){ ?>
                        <h1> <span class="badge bg-warning text-light">BOLETO DE OTRO DÍA</span> <h1>
                    <?php } else if($boleto->getEstado() == 2){ ?>
                    <h1> <span class="badge bg-danger text-light">BOLETO CANCELADO</span> <h1>
                    <?php } else if($boleto->getEstado() == 3) { ?>
                    <h1> <span class="badge bg-warning text-light">BOLETO UTILIZADO</span> <h1>
                    <?php } else if($boleto->getEstado() == 4) { ?>
                    <h1> <span class="badge bg-danger text-light">BOLETO CADUCADO</span> <h1>
                    <?php } else { ?>
                    <h1> <span class="badge bg-danger text-light">BOLETO NO PAGADO</span> <h1>
                    <?php } ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php
    } else {
        header("Location: ".WEB_URL."/admin");
    }
    include '../app/Includes/Admin/Footer.php';
?>
