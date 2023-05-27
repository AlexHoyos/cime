<?php

include '../app/main.php';
include '../app/Includes/Admin/Dashboard.php';

$date = $fechaHoy->format('Y-m-d');

if(isset($_GET["fecha"])){
    $date = $_GET["fecha"];
}

$resumenVentas = $admin->getResumenVentas($date);
$ventas = $admin->getVentas($date);
$subtotal = floatval($resumenVentas->subtotal_adultos+$resumenVentas->subtotal_adols+$resumenVentas->subtotal_ninos);
?>

    <div class="d-flex flex-column w-100 p-4" id="reporte_ventas">

        <div class="d-flex flex-row w-100 justify-content-center">
            <h2 class="super-title">Reporte ventas</h2>
        </div>

        <div class="d-flex flex-row justify-content-around">

            <div class="d-flex flex-column">
                <input type="date" value="<?=$date?>" onchange="insertParam('fecha', this.value)" class="form-control">
                <b class="my-2" >** BOLETOS VENDIDOS **</b>
                <p> Adultos - <?=$resumenVentas->adultos?> - $<?=number_format($resumenVentas->subtotal_adultos, 2)?> </p>
                <p> Adolescentes - <?=$resumenVentas->adols?> - $<?=number_format($resumenVentas->subtotal_adols, 2)?> </p>
                <p> Niños - <?=$resumenVentas->ninos?> - $<?=number_format($resumenVentas->subtotal_ninos, 2)?> </p>
            </div>
            <div class="d-flex flex-column">
                <button class="btn btn-secondary" onclick="imprimirElemento( document.getElementById('reporte_ventas') )">Imprimir</button>
                <h3>
                    <b>Total en caja</b>
                    <p>$<?=number_format($subtotal, 2)?></p>
                </h3>
            </div>

        </div>

        <div class="d-flex flex-column">

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Info</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($ventas as $boletoVendido){
                        $funcion = $boletoVendido->getFuncionInstance();
                        $total = floatval( floatval($funcion->getPrecioAdulto()*$boletoVendido->getNumAdultos()) +
                                    floatval($funcion->getPrecioAdol()*$boletoVendido->getNumAdols()) +
                                    floatval($funcion->getPrecioNino()*$boletoVendido->getNumNinos()) );
                    ?>
                    <tr>
                        <th scope="row"><?=$boletoVendido->getId()?></th>
                        <td><?=$funcion->getPelicula()->getTitulo()?></td>
                        <td>$<?=number_format($total,2)?></td>
                        <td> <a href="boleto.php?id=<?=$boletoVendido->getId()?>" class="btn btn-success">Ver</a> </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>

    <?php
    include '../app/Includes/Admin/Footer.php';
    ?>
    </body>
</html>

