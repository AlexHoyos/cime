<?php

use CIME\Filters\CRUDPageFilter;
use CIME\Models\Formato;
use CIME\Models\Funcion;
use CIME\Models\Idioma;
use CIME\Models\Pelicula;
use CIME\Models\Sala;

    include '../app/main.php';
    include '../app/Includes/Admin/Dashboard.php';

    $page = CRUDPageFilter::getPageNumber();
    $orderBy = CRUDPageFilter::getOrderBy();
    $condition = CRUDPageFilter::getCondition("fecha");

    $nextPageAdd = "";
    if(empty($condition) == false)
        $nextPageAdd .= '&search='.$_GET["search"];
    
    $funcionesPagination = Funcion::getAll([], $condition, $orderBy);
    $funciones = $funcionesPagination->page($page);
    $availablePages = $funcionesPagination->totalPages();

?>

<!-- MODAL -->
<div class="modal modal-lg" tabindex="-1" role="dialog" id="objectModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" onclick="hideModal()" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="idFuncion">
        <input type="hidden" id="idPelicula">
        <label for="pelicula">Pelicula:</label>
        <h5><b id="nombrePelicula"></b></h5>
        <label for="dia">Día:</label>
        <input type="date" name="dia" id="dia" class="form-control" min="<?= date('Y-m-d'); ?>">
        <label for="hora">Hora:</label>
        <input type="time" name="hora" id="hora" class="form-control">
        <label for="formato">Formato:</label>
        <select name="formato" id="formato" class="form-control">
            <?php 
                $formatos = Formato::getAll()->showAll();
                foreach($formatos as $formato){
                    $formato = (object) $formato;
            ?>
                <option value="<?=$formato->id?>"><?=$formato->nombre?></option>
            <?php } ?>
        </select>
        <label for="idioma">Idioma:</label>
        <select name="idioma" id="idioma" class="form-control">
            <?php 
                $idiomas = Idioma::getAll()->showAll();
                foreach($idiomas as $idioma){
                    $idioma = (object) $idioma;
            ?>
                <option value="<?=$idioma->id?>"><?=$idioma->nombre?></option>
            <?php } ?>
        </select>
        <label for="subtitulos">Subtitulos:</label>
        <select name="subtitulos" id="subtitulos" class="form-control">
            <option value="0" selected>Sin subtitulos</option>
            <?php 
                foreach($idiomas as $subtitulo){
                    $subtitulo = (object) $subtitulo;
            ?>
                <option value="<?=$subtitulo->id?>"><?=$subtitulo->nombre?></option>
            <?php } ?>
        </select>
        <label for="idSala">Sala:</label>
        <select name="idSala" id="idSala" class="form-control">
            <?php
            $salas = Sala::getAll()->showAll();
            foreach($salas as $sala){
                $sala = (object) $sala;
            ?>
            <option value="<?=$sala->id?>"><?=$sala->nombre?></option>
            <?php } ?>
        </select>
        <label for="precio_adulto">Precio Adulto:</label>
        <input type="number" name="precio_adulto" id="precio_adulto" placeholder="Precio adultos" class="form-control">
        <label for="precio_adol">Precio Adolescentes:</label>
        <input type="number" name="precio_adol" id="precio_adol" placeholder="Precio adultos" class="form-control">
        <label for="precio_nino">Precio Niños:</label>
        <input type="number" name="precio_nino" id="precio_nino" placeholder="Precio adultos" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveBtn" onclick="add()">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<section class="d-flex flex-column justify-content-center align-items-center ms-2 mt-2 w-100" id="crud">
    <h2 class="super-title">Funciones</h2>
    <article class="row m-0 d-0 w-100">

    <?php 
        if(isset($_GET["id"])){

        $funcion = Funcion::getById(intval($_GET["id"]));
        if($funcion instanceof Funcion){
    ?>
        <div class="col-12 d-flex flex-column align-items-center justify-content-center py-3">
            <div class="card w-100">
                <h5 class="card-header">
                    <?=$funcion->getPelicula()->getTitulo()?>
                </h5>
                <div class="card-body row">
                    <div class="col-12 col-md-4 d-flex flex-column">
                        <div class="d-flex">
                            <h5><b>Formato: </b></h5>
                            <p><?=$funcion->getFormato()->getNombre()?></p>
                        </div>
                        <div class="d-flex">
                            <h5><b>Idioma: </b></h5>
                            <p><?=$funcion->getIdioma()->getNombre()?></p>
                        </div>
                        <div class="d-flex">
                            <h5><b>Subtitulos: </b></h5>
                            <?php
                                $subtitulos = $funcion->getSubtitulos();
                            ?>
                            <p><?=($subtitulos == null)?"N/T":$subtitulos->getNombre()?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex flex-column">
                        <div class="d-flex">
                            <h5><b>Dia: </b></h5>
                            <p><?=$funcion->getFecha()?></p>
                        </div>
                        <div class="d-flex">
                            <h5><b>Hora: </b></h5>
                            <p><?=$funcion->getHora()?></p>
                        </div>
                        <div class="d-flex">
                            <h5><b>Sala: </b></h5>
                            <p><?=$funcion->getSala()->getNombre()?></p>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 d-flex flex-column">
                        <div class="d-flex">
                            <h5><b>Adulto: </b></h5>
                            <p>$<?=number_format($funcion->getPrecioAdulto(), 2, '.', '')?></p>
                        </div>
                        <div class="d-flex">
                            <h5><b>Adolescente: </b></h5>
                            <p>$<?=number_format($funcion->getPrecioAdol(), 2, '.', '')?></p>
                        </div>
                        <div class="d-flex">
                            <h5><b>Niño: </b></h5>
                            <p>$<?=number_format($funcion->getPrecioNino(), 2, '.', '')?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php } } ?>
        <div class="col-6 col-md-4 ps-5">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Busqueda" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6 col-md-8 pl-5 d-flex flex-row justify-content-end">
            <a class="btn btn-primary d-flex align-items-center" href="Peliculas.php">+ Crear</a>
        </div>

        <div class="col-12 d-flex flex-row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Pelicula</th>
                    <th scope="col">Formato</th>
                    <th scope="col">Idioma</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($funciones as $funcion){
                        $funcion = Funcion::transformRow((object) $funcion)
                    ?>
                    <tr>
                        <th scope="row"><?=$funcion->getId()?></th>
                        <td><?=$funcion->getPelicula()->getTitulo()?></td>
                        <td><?=$funcion->getFormato()->getNombre()?></td>
                        <td><?=$funcion->getIdioma()->getNombre()?></td>
                        <td><?=$funcion->getFecha()?> <?=$funcion->getHora()?></td>
                        <td>
                            <a href="?id=<?=$funcion->getId()?>" class="btn btn-success">Ver</a>
                            <button class="btn btn-warning" onclick="openEdit(<?=$funcion->getId()?>)">Editar</button>
                            <button class="btn btn-danger" onclick="deleteObject(<?=$funcion->getId()?>)">Eliminar</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <?php require('../app/Includes/PageNavigation.php'); ?>
        </div>
    </article>
</section>

<?php
    include '../app/Includes/Admin/Footer.php';
?>
<script>
    function openModal(){
        $("#objectModal").modal('show')
    }

    <?php
        if(isset($_GET["peliId"])){
            $peli = Pelicula::getById(intval($_GET["peliId"]));
            if($peli instanceof Pelicula){    
        ?>
        $(window).on("load", function(){
            $("#idPelicula").val(<?=intval($_GET["peliId"])?>)
            $("#nombrePelicula").text("<?=$peli->getTitulo()?>")
            openModal()
        })
    <?php } } ?>

    function hideModal(){
        $("#objectModal").modal('hide')
    }

    function openEdit(id){
        $.ajax({
            type: "GET",
            url: '../app/Controllers/CRUD/Funciones.php?id='+id,
            data: {},
            success: function(response)
            {
                console.log(response)
                $("#idFuncion").val(id)
                $("#idPelicula").val(response.id_pelicula)
                $("#nombrePelicula").text(response.titulo_pelicula)
                $("#dia").val(response.fecha)
                $("#hora").val(response.hora)
                $("#formato").val(response.id_formato)
                $("#idioma").val(response.id_idioma)
                if(response.id_subtitulos != null)
                    $("#subtitulos").val(response.id_subtitulos)

                $("#idSala").val(response.id_sala)
                $("#precio_adulto").val(response.precio_adulto)
                $("#precio_adol").val(response.precio_adol)
                $("#precio_nino").val(response.precio_nino)
                $("#saveBtn").attr('onclick', 'edit()')
                if(response.ninos){
                    $("#siNinos").prop('checked', true)
                } else {
                    $("#noNinos").prop('checked', true)
                }
                
                if(response.adolescentes){
                    $("#siAdols").prop('checked', true)
                } else if(response.adol_adult){
                    $("#adultsAdols").prop('checked', true)
                } else {
                    $("#noAdols").prop('checked', true)
                }

                openModal()
            },
            error: function(res){
                console.log(res)
            }
       });
    }

    function openAdd(){
        $("#idClasificacion").val("")
        $("#nombreClasificacion").val("")
        $("#descripcionClasificacion").val("")
        $("#siNinos").prop('checked', true)
        $("#siAdols").prop('checked', true)
        $("#saveBtn").attr('onclick', 'add()')
        openModal()
    }

    function add(){
        var data = getData()
        var button = document.getElementById("saveBtn")
        $.ajax({
            type: "POST",
            url: '../app/Controllers/CRUD/Funciones.php',
            data: data,
            beforeSend: function(){
                
                loadingButton(button)
            },
            complete: function(){
                loadingButton(button, true)
            },
            success: function(response)
            {

                alert("Función agregada!");
                window.location.href="Funciones.php"
            },
            error: function(response){
                console.log(data)
                console.log(response)
                alert(response.responseJSON.error)
            }
       });
    }

    function edit(){
        var data = getData()
        var button = document.getElementById("saveBtn")
        $.ajax({
            type: "PUT",
            url: '../app/Controllers/CRUD/Funciones.php',
            data: data,
            beforeSend: function(){
                
                loadingButton(button)
            },
            complete: function(){
                loadingButton(button, true)
            },
            success: function(response)
            {

                alert("Función editada!");
                window.location.reload()
            },
            error: function(response){
                console.log(data)
                console.log(response)
                alert(response.responseJSON.error)
            }
       });
    }
    function deleteObject(id){
        $.ajax({
            type: "DELETE",
            url: '../app/Controllers/CRUD/Funciones.php',
            data: {id:id},
            success: function(response)
            {

                alert("Funcion eliminada!");
                window.location.reload()
            },
            error: function(response){
                console.log(response)
            }
       });
    }

    function updateDefaultPrecio(){

    }

    function getData(){
        return {
            id: $("#idFuncion").val(),
            id_pelicula: $("#idPelicula").val(),
            dia: $("#dia").val(),
            hora: $("#hora").val(),
            id_formato: $("#formato").val(),
            id_idioma: $("#idioma").val(),
            id_subtitulos: $("#subtitulos").val(),
            id_sala: $("#idSala").val(),
            precio_adulto: $("#precio_adulto").val(),
            precio_adol: $("#precio_adol").val(),
            precio_nino: $("#precio_nino").val()
        }
    }
</script>