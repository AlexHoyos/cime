<?php

use CIME\Models\Funcion;

include '../app/main.php';
include '../app/Includes/Admin/Dashboard.php';

$step = 2;
if(isset($_GET["step"]))
    $step = intval($_GET["step"]);

if($step < 2)
    $step = 2;

$funcionID = 0;
if(isset($_GET["funcion"]))
    $funcionID = intval($_GET["funcion"]);

$funcion = Funcion::getById($funcionID);

if($funcion instanceof Funcion){
    $pelicula = $funcion->getPelicula();

?>

<section class="row m-0 p-0 py-1 w-100" id="reservar">     
<input type="hidden" value="<?=$step?>" id="step">
    <?php if($step == 2){
         $subtotal = $funcion->getPrecioAdulto();
         $clasificacion = $funcion->getPelicula()->getClasificacionInstance();
    ?>
         <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center">

            <h3>Seleccion de personas</h3>

             <input type="hidden" value="<?=$funcion->getPrecioAdulto()?>" id="precioAdulto">
             <input type="hidden" value="<?=$funcion->getPrecioAdol()?>" id="precioAdol">
             <input type="hidden" value="<?=$funcion->getPrecioNino()?>" id="precioNino">

             <div class="d-flex flex-row w-50 align-items-center">
                <div class="btn-group">
                    <button class="btn btn-danger p-4" onclick="document.getElementById('cant_adultos').value--;updateSubtotal()">-</button>
                    <button class="btn btn-success p-4" onclick="document.getElementById('cant_adultos').value++;updateSubtotal()">+</button>
                </div>
                 <label for="cant_adultos">Adultos $<?=number_format($funcion->getPrecioAdulto(), 2)?>: </label>
                 <input type="number" name="cant_adultos" id="cant_adultos" min="<?=($clasificacion->isForAdolAdult())?"1":"0"?>" value="1" class="form-control" onchange="updateSubtotal()">
             </div>
         <br>
             <div class="d-flex flex-row w-50">
                <div class="btn-group">
                    <button class="btn btn-danger p-4" onclick="document.getElementById('cant_adols').value--;updateSubtotal()">-</button>
                    <button class="btn btn-success p-4" onclick="document.getElementById('cant_adols').value++;updateSubtotal()">+</button>
                </div>
                 <label for="cant_adols">Adolescentes $<?=number_format($funcion->getPrecioAdol(), 2)?>: </label>
                 <input type="number" name="cant_adols" id="cant_adols" min="0" value="0" class="form-control" onchange="updateSubtotal()" <?=($clasificacion->isForAdolAdult() || $clasificacion->isForAdolescentes())?"":"disabled"?> >
             </div>
         <br>
             <div class="d-flex flex-row w-50">
                <div class="btn-group">
                    <button class="btn btn-danger p-4" onclick="document.getElementById('cant_ninos').value--;updateSubtotal()">-</button>
                    <button class="btn btn-success p-4" onclick="document.getElementById('cant_ninos').value++;updateSubtotal()">+</button>
                </div>
                 <label for="cant_ninos">Niños $<?=number_format($funcion->getPrecioNino(), 2)?>: </label>
                 <input type="number" name="cant_ninos" id="cant_ninos" min="0" value="0" class="form-control" onchange="updateSubtotal()" <?=($clasificacion->isForNinos())?"":"disabled"?>>
             </div>
         <br>
         <div>
             <p>Subtotal: <b id="subtotal">$<?=number_format($subtotal, 2)?></b></p>
         </div>
         <button class="btn btn-primary btn-block w-50 p-4" onclick="saveBoletos()">Continuar</button>
         <a href="cartelera.php?pelicula=<?=$pelicula->getId()?>" class="btn btn-dark w-50 p-4 my-2">Regresar</a>
     </div>
     <?php } else if($step == 3) { ?>
        <div class="d-flex flex-column w-100 h-100 justify-content-center align-items-center">
            <h3>Seleccion de asientos</h3>
            <br>
            <?=$funcion->getSala()->getMapaSala()->getHtmlUserInput($funcion)?>
            <br>
            <div class="d-flex flex-column w-100 justify-content-center align-items-center">
                <button class="btn btn-primary w-50 p-4" onclick="saveAsientos()">Continuar</button>
                <a href="reservar.php?funcion=<?=$funcionID?>" class="btn btn-dark w-50 p-4 my-2">Regresar</a>
            </div>
        </div>
    <?php } else if($step == 4){ ?>
        <h4>Resumen pedido:</h4>
        <p>Total asientos: <b id="total_asientos">0</b></p>
        <p>-- Adultos: <b id="asientos_adultos">0</b></p>
        <p>-- Adolescentes: <b id="asientos_adols">0</b></p>
        <p>-- Niños: <b id="asientos_ninos">0</b></p>
        <p>Subtotal: <b id="subtotal">$100</b></p>
        <!-- isset($_POST["asientos"], $_POST["adultos"], $_POST["adols"], $_POST["ninos"], $_POST["funcion_id"], $_POST["correo"] -->
        <form action="<?=WEB_URL?>/app/Controllers/BoletoPayment.php?funcion_id=<?=$_GET["funcion"]?>&admin=true" method="post">
            <input type="hidden" name="asientos" id="asientos">
            <input type="hidden" name="adultos" id="adultos">
            <input type="hidden" name="adols" id="adols">
            <input type="hidden" name="ninos" id="ninos">
            <input type="hidden" name="correo" id="correo">

            <button class="btn btn-primary w-50 p-4" type="submit">Completar venta</button>
            <a href="reservar.php?funcion=<?=$funcionID?>&step=3" class="btn btn-dark w-50 p-4 my-2">Regresar</a>
        </form>
    <?php } ?>

</section> 
<?php 
}
include '../app/Includes/Admin/Footer.php'; ?>
<script src="../assets/js/utils.cime.js"></script>
<script src="../assets/js/reservacion.js"></script>
</body>
</html>