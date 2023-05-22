<?php

use CIME\Models\Boleto;

include '../app/main.php';
include '../app/Includes/Admin/Dashboard.php';

$fechaInicio = $fechaHoy->format('Y-m-d');
$fechaFin = $fechaHoy->format('Y-m-d');

if(isset($_GET["fechaInicio"])){
    $fechaInicio = $_GET["fechaInicio"];
}

if(isset($_GET["fechaFin"])){
    $fechaFin = $_GET["fechaFin"];
}

if($fechaInicio > $fechaFin)
    $fechaFin = $fechaInicio;

$ingresosStats = Boleto::getIngresosStats($fechaInicio, $fechaFin);

$ingresosOnline = 0;
$ingresosFisico = 0;
foreach($ingresosStats as $ingresoStat){
    if($ingresoStat->fisico == 1)
        $ingresosFisico = $ingresoStat->subtotal;
    else
        $ingresosOnline = $ingresoStat->subtotal;
}

$ingresoTotal = floatval($ingresosFisico+$ingresosOnline);

$peliculasVisitadas = Boleto::getVisitasStats($fechaInicio, $fechaFin);
$boletosReservados = Boleto::getTiposVentaStats($fechaInicio, $fechaFin);
?>

    <div class="d-flex flex-column w-100 p-4">

        <div class="d-flex flex-row w-100 justify-content-center">
            <h2 class="super-title">Estadisticas</h2>
        </div>

        <div class="d-flex flex-row justify-content-around">

            <div class="d-flex flex-column w-50">
                <label for="fechaInicio">Fecha inicio</label>
                <input type="date" name="fechaInicio" id="fechaInicio"  onchange="insertParam('fechaInicio', this.value)" value="<?=$fechaInicio?>" class="form-control w-75">
            </div>
            <div class="d-flex flex-column w-50">
                <label for="fechaFin">Fecha final</label>
                <input type="date" name="fechaFin" id="fechaFin"  onchange="insertParam('fechaFin', this.value)" value="<?=$fechaFin?>" class="form-control w-75">
            </div>

        </div>
        <?php if($ingresoTotal > 0){ ?>
        <div class="row my-2 p-2">
            <div class="col-6 p-2 bg-primary text-light">
                <pre>Ingreso online</pre>
                <h3>$<?=number_format($ingresosOnline, 2)?> (<?=number_format(($ingresosOnline/$ingresoTotal)*100, 2)?>%) </h3>
            </div>
            <div class="col-6 p-2 bg-warning">
                <pre>Ingreso físico</pre>
                <h3>$<?=number_format($ingresosFisico, 2)?> (<?=number_format(($ingresosFisico/$ingresoTotal)*100, 2)?>%) </h3>
            </div>
            <div class="col-12 p-2 bg-secondary text-light">
                <pre>Ingreso total</pre>
                <h3>$<?=number_format($ingresoTotal, 2)?></h3>
            </div>
            <div class="col-12 p-2 d-flex justify-content-center">
                <canvas id="ingresosChart" aria-label="chart" height="350" width="580"></canvas>
            </div>
        </div>

        <div class="d-flex w-100 p-2">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">Pelicula</th>
                    <th scope="col">Visitas</th>
                    <th scope="col">Adultos</th>
                    <th scope="col">Adols</th>
                    <th scope="col">Niños</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $totalVisitas = 0;
                    foreach($peliculasVisitadas as $pelicula){
                        $titulo = $pelicula->titulo;
                        $visitas = $pelicula->visitas;
                        $totalVisitas += $visitas;
                        $adultos = number_format( ( ($pelicula->adultos/$visitas)*100 ), 2);
                        $adols = number_format( ( ($pelicula->adols/$visitas)*100 ), 2);
                        $ninos = number_format( ( ($pelicula->ninos/$visitas)*100 ), 2);
                    ?>
                    <tr>
                        <td><?=$titulo?></td>
                        <td><?=$visitas?></td>
                        <td><?=$adultos?>%</td>
                        <td><?=$adols?>%</td>
                        <td><?=$ninos?>%</td>
                    </tr>
                    <?php } ?>
                    <tr class="bg-secondary text-light">
                        <td><b>Total visitas:</b></td>
                        <td><?=$totalVisitas?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex flex-row justify-content-around">
                        
            <div class="d-flex flex-column">
                <h4>Boletos reservados</h4>
                <p><?=intval($boletosReservados->total)?></p>
            </div>
            <div class="d-flex flex-column">
                <h4>Utilizados</h4>
                <p><?= number_format( (intval($boletosReservados->usados)/$boletosReservados->total)*100,  2) ?>%</p>
            </div>
            <div class="d-flex flex-column">
                <h4>No utilizados</h4>
                <p><?= number_format( (intval($boletosReservados->no_usados)/$boletosReservados->total)*100,  2) ?>%</p>
            </div>

        </div>

    </div>

    <?php
        }
    include '../app/Includes/Admin/Footer.php';
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.1/chart.min.js"></script>
    <script>
      var chrt = document.getElementById("ingresosChart").getContext("2d");
      var chartId = new Chart(chrt, {
         type: 'doughnut',
         data: {
            labels: ["FISICO", "ONLINE"],
            datasets: [{
            label: "Medios de ingreso",
            data: [<?=$ingresosFisico?>, <?=$ingresosOnline?>],
            backgroundColor: ['yellow', 'lightblue'],
            hoverOffset: 5
            }],
         },
         options: {
            responsive: false,
         },
      });
   </script>
    </body>
</html>