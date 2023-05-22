<?php

use CIME\Filters\SessionFilter;
use CIME\Models\Funcion;

    include './app/main.php';
    include './app/Includes/header.php';

    $step = 1;
    if(isset($_GET["step"]))
        $step = intval($_GET["step"]);
    
    if($step == 1 && SessionFilter::existsUserSession(""))
        $step = 2;

    $funcionID = 0;
    if(isset($_GET["funcion"]))
        $funcionID = intval($_GET["funcion"]);

    $funcion = Funcion::getById($funcionID);

    if($funcion instanceof Funcion){
        $pelicula = $funcion->getPelicula();
?>
<section class="row m-0 p-0 py-1" id="reservar">
    <div class="col-12" id="pageTitle">
        <h1>Reservación</h1>
    </div>
    <input type="hidden" value="<?=$step?>" id="step">
    <div class="row">

        <div class="col-12 d-flex justify-content-center">
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
                <button type="button" class="btn <?=($step == 1)?"btn-secondary":"btn-outline-secondary"?>">1. Cliente</button>
                <button type="button" class="btn <?=($step == 2)?"btn-secondary":"btn-outline-secondary"?>">2. Boletos</button>
                <button type="button" class="btn <?=($step == 3)?"btn-secondary":"btn-outline-secondary"?>">3. Asientos</button>
                <button type="button" class="btn <?=($step == 4)?"btn-secondary":"btn-outline-secondary"?>">4. Pago</button>
            </div>
        </div>

        <div class="col-12 col-md-6">

            <?php if($step == 1) { ?>
                
            <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center">
                <a href="<?=WEB_URL?>/login.php" class="btn btn-primary btn-block p-2 w-100">Iniciar sesión</a>
                <b class="my-1">Ó</b>
                
                <div class="form-group row m-0 p-0 w-100">
                    <div class="col-8">
                        <input type="text" name="correo" id="correo" placeholder="Correo electronico" class="form-control">
                    </div>
                    <div class="col-4">
                        <button class="btn btn-primary w-100" onclick="saveEmail()">Usar correo</button>
                    </div>
                    
                </div>

            </div>
                

            <?php } else if($step == 2) {
                $subtotal = $funcion->getPrecioAdulto();
                $clasificacion = $funcion->getPelicula()->getClasificacionInstance();
                ?>
                <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center">

                    <input type="hidden" value="<?=$funcion->getPrecioAdulto()?>" id="precioAdulto">
                    <input type="hidden" value="<?=$funcion->getPrecioAdol()?>" id="precioAdol">
                    <input type="hidden" value="<?=$funcion->getPrecioNino()?>" id="precioNino">

                    <div class="d-flex flex-row w-50">
                        <label for="cant_adultos">Adultos $<?=number_format($funcion->getPrecioAdulto(), 2)?>: </label>
                        <input type="number" name="cant_adultos" id="cant_adultos" min="<?=($clasificacion->isForAdolAdult())?"1":"0"?>" value="1" class="form-control" onchange="updateSubtotal()">
                    </div>
                <br>
                    <div class="d-flex flex-row w-50">
                        <label for="cant_adols">Adolescentes $<?=number_format($funcion->getPrecioAdol(), 2)?>: </label>
                        <input type="number" name="cant_adols" id="cant_adols" min="0" value="0" class="form-control" onchange="updateSubtotal()" <?=($clasificacion->isForAdolAdult() || $clasificacion->isForAdolescentes())?"":"disabled"?> >
                    </div>
                <br>
                    <div class="d-flex flex-row w-50">
                        <label for="cant_ninos">Niños $<?=number_format($funcion->getPrecioNino(), 2)?>: </label>
                        <input type="number" name="cant_ninos" id="cant_ninos" min="0" value="0" class="form-control" onchange="updateSubtotal()" <?=($clasificacion->isForNinos())?"":"disabled"?>>
                    </div>
                <br>
                <div>
                    <p>Subtotal: <b id="subtotal">$<?=number_format($subtotal, 2)?></b></p>
                </div>
                <button class="btn btn-primary btn-block w-50" onclick="saveBoletos()">Continuar</button>
            </div>
            <?php } else if($step == 3) { ?>

                <br>
                <?=$funcion->getSala()->getMapaSala()->getHtmlUserInput($funcion)?>
                <div class="d-flex w-100 justify-content-center">
                    <button class="btn btn-primary w-50" onclick="saveAsientos()">Continuar</button>
                </div>
            <?php } else if($step == 4) { ?>

                <h4>Resumen pedido:</h4>
                <p>Total asientos: <b id="total_asientos">0</b></p>
                <p>-- Adultos: <b id="asientos_adultos">0</b></p>
                <p>-- Adolescentes: <b id="asientos_adols">0</b></p>
                <p>-- Niños: <b id="asientos_ninos">0</b></p>
                <p>Subtotal: <b id="subtotal">$100</b></p>
                <!-- isset($_POST["asientos"], $_POST["adultos"], $_POST["adols"], $_POST["ninos"], $_POST["funcion_id"], $_POST["correo"] -->
                <form action="<?=WEB_URL?>/app/Controllers/BoletoPayment.php?funcion_id=<?=$_GET["funcion"]?>" method="post">
                    <input type="hidden" name="asientos" id="asientos">
                    <input type="hidden" name="adultos" id="adultos">
                    <input type="hidden" name="adols" id="adols">
                    <input type="hidden" name="ninos" id="ninos">
                    <input type="hidden" name="correo" id="correo">

                    <button class="btn btn-primary w-75" type="submit">Reservar y pagar</button>
                </form>
            <?php } ?>

        </div>

        <div class="col-12 col-md-6 d-flex flex-row justify-content-end">

            <div class="p-1">
                <h3>
                    <?=$pelicula->getTitulo()?>
                </h3>
                <p>Formato: <b><?=$funcion->getFormato()->getNombre()?></b></p>
                <p>Idioma: <b><?=$funcion->getIdioma()->getNombre()?></b></p>
                <p>Subtitulos: <b><?=($funcion->getSubtitulos() != null)?$funcion->getSubtitulos()->getNombre():"N/T"?></b></p>
                <p>Fecha: <b><?=$funcion->getFecha()?></b></p>
                <p>Hora: <b><?=$funcion->getHora()?></b></p>
            </div>
            <div class="col-12 col-md-6 col-lg-4 div-img m-1"
                style="min-height: 350px;background-image: url(<?=WEB_URL?>/app/Storage/peliculas/<?=$pelicula->getPortada()?>);width: 250px;margin-left: 20px;cursor:pointer;">
            </div>

        </div>

    </div>

</section>

<script src="<?=WEB_URL?>/assets/js/utils.cime.js"></script>
<script src="<?=WEB_URL?>/assets/js/reservacion.js"></script>

<?php

    } else {
        //header("Location: /");
    }

    include './app/Includes/footer.php';

?>