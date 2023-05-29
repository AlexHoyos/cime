<?php

use CIME\Filters\CRUDPageFilter;
use CIME\Models\MapaSala;
use CIME\Models\Sala;

    include '../app/main.php';
    include '../app/Includes/Admin/Dashboard.php';

    $page = CRUDPageFilter::getPageNumber();
    $orderBy = CRUDPageFilter::getOrderBy();
    $condition = CRUDPageFilter::getCondition("nombre");

    $nextPageAdd = "";
    if(empty($condition) == false)
        $nextPageAdd .= '&search='.$_GET["search"];
    
    $salasPagination = Sala::getAll([], $condition, $orderBy);
    $salas = $salasPagination->page($page);
    $availablePages = $salasPagination->totalPages();

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
        <input type="hidden" id="idSala">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombreSala" placeholder="Nombre" class="form-control">
        <label for="descripcion">MAPA DE ASIENTOS:</label>
        <div class="d-flex flex-row justify-content-around my-1">
            <input type="number" placeholder="filas" id="filas" value="10" class="form-control">
            <input type="number" placeholder="columnas" id="columnas" value="10" class="form-control">
            <button class="btn btn-primary" onclick="setSizeOfMapInput()">Actualizar</button>
        </div>
        <div id="mapaInput"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveBtn">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<section class="d-flex flex-column justify-content-center align-items-center ms-2 mt-2 w-100" id="crud">
    <h2 class="super-title">Salas</h2>
    <article class="row m-0 d-0 w-100">

    <?php
        $SalaInstance = null; 
        if(isset($_GET["id"])){

        $sala = Sala::getById(intval($_GET["id"]));
        $SalaInstance = $sala;
        if($sala instanceof Sala){
    ?>
        <div class="col-12 d-flex flex-column align-items-center justify-content-center py-3" >
            <div class="card">
                <h5 class="card-header">Sala: <?=$sala->getNombre()?></h5>
                <div class="card-body">
                    <h5 class="card-title">MAPA DE ASIENTOS: </h5>
                    <p class="card-text" id="mapaSala">
                        <?php
                        $mapaSala = (object) $sala->toArray()["mapaSala"];
                        $filas = $mapaSala->filas;
                        $columnas = $mapaSala->columnas;
                        echo $sala->getMapaSala()->getHtmlMap();
                        ?>
                    </p>
                    
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
            <button class="btn btn-primary" onclick="openAdd()">+ Crear</button>
        </div>

        <div class="col-12 d-flex flex-row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($salas as $sala){
                    ?>
                    <tr>
                        <th scope="row"><?=$sala["id"]?></th>
                        <td><?=$sala["nombre"]?></td>
                        <td>
                            <a href="?id=<?=$sala["id"]?>" class="btn btn-success">Ver</a>
                            <button class="btn btn-warning" onclick="openEdit(<?=$sala['id']?>)">Editar</button>
                            <button class="btn btn-danger" onclick="deleteObject(<?=$sala['id']?>)">Eliminar</button>
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
<script src="../assets/js/Sala.js"></script>
<script>
    function openModal(){
        $("#objectModal").modal('show')
    }

    function hideModal(){
        $("#objectModal").modal('hide')
    }

    function openEdit(id){
        $.ajax({
            type: "GET",
            url: '../app/Controllers/CRUD/Salas.php?id='+id,
            data: {},
            success: function(response)
            {
                console.log(response)
                $("#idSala").val(id)
                $("#nombreSala").val(response.nombre)
                $("#filas").val(response.mapaSala.filas)
                $("#columnas").val(response.mapaSala.columnas)
                setSizeOfMapInput(function () {
                    var asientos = response.mapaSala.asientos
                    asientos.forEach(function(asiento) {
                        console.log($("div[data-fila=\""+asiento.fila+"\"][data-columna=\""+asiento.columna+"\"]").children().val(asiento.nombre))
                    })
                    $("#saveBtn").attr('onclick', 'edit()')
                    openModal()
                })
                
                
            },
            error: function(res){
                console.log(res)
            }
       });
    }

    function openAdd(){
        $("#idSala").val("")
        $("#nombreSala").val("")
        $("#saveBtn").attr('onclick', 'add()')
        setSizeOfMapInput( openModal() )
    }

    function setSizeOfMapInput(callback = function() {}){
        var filas = document.getElementById("filas").value
        var columnas = document.getElementById("columnas").value
        $.ajax({
            type: "GET",
            url: '../app/Controllers/CRUD/Salas.php?mapInput=true&filas='+filas+'&columnas='+columnas,
            data: {},
            success: function(response)
            {
                console.log(response)
                document.getElementById("mapaInput").innerHTML = response.html
                callback()
            },
            error: function(res){
                console.log("xd");
                console.log(res)
            }
       });
    }

    function add(){
        var asientosDOM = $("*[data-asiento]")
        var asientos = []
        asientosDOM.each(function (index) {
            console.log($(this).val())
            let posibleAsiento = $(this)
            if(posibleAsiento.val() != "")
                asientos.push(JSON.stringify({
                    nombre: posibleAsiento.val(),
                    fila: posibleAsiento.parent().attr("data-fila"),
                    columna: posibleAsiento.parent().attr("data-columna")
                }))
        }).promise().done(function(){
            var data = getData();
            data["asientos[]"] = asientos
            var button = document.getElementById("saveBtn")
            $.ajax({
                type: "POST",
                url: '../app/Controllers/CRUD/Salas.php',
                data: data,

                beforeSend: function(){
                    
                    loadingButton(button)
                },
                complete: function(){
                    loadingButton(button, true)
                },
                success: function(response)
                {

                    alert("Sala agregada!");
                    window.location.reload()
                },
                error: function(response){
                    console.log(data)
                    console.log(response)
                    alert("Error al agregar sala")
                    alert(response.responseJSON.error)
                }
            });

        })

        
        /*
        $.ajax({
            type: "POST",
            url: '../app/Controllers/CRUD/Salas.php',
            data: getData(),
            success: function(response)
            {

                alert("Sala agregada!");
                window.location.reload()
            },
            error: function(response){
                console.log({nombre:nombre, descripcion:descripcion, ninos:ninos, adols:adols})
                console.log(response)
            }
       });*/
    }

    function edit(){

        var asientosDOM = $("*[data-asiento]")
        var asientos = []
        asientosDOM.each(function (index) {
            console.log($(this).val())
            let posibleAsiento = $(this)
            if(posibleAsiento.val() != "")
                asientos.push(JSON.stringify({
                    nombre: posibleAsiento.val(),
                    fila: posibleAsiento.parent().attr("data-fila"),
                    columna: posibleAsiento.parent().attr("data-columna")
                }))
        }).promise().done(function(){
            var data = getData();
            data["asientos[]"] = asientos
            var button = document.getElementById("saveBtn")
            $.ajax({
                type: "PUT",
                url: '../app/Controllers/CRUD/Salas.php',
                data: data,
                beforeSend: function(){
                    
                    loadingButton(button)
                },
                complete: function(){
                    loadingButton(button, true)
                },
                success: function(response)
                {
                    alert("Sala actualizada!");
                    window.location.reload()
                },
                error: function(response){
                    console.log(data)
                    console.log(response)
                    alert("Error al actualizar sala")
                    alert(response.responseJSON.error)
                }
            });

        })
    }
    function deleteObject(id){
        $.ajax({
            type: "DELETE",
            url: '../app/Controllers/CRUD/Salas.php',
            data: {id:id},
            success: function(response)
            {

                alert("Sala eliminada!");
                window.location.reload()
            },
            error: function(response){
                console.log(response)
                alert("Error al eliminar la sala, asegurese que no haya alguna función relacionada con ella")
            }
       });
    }

    function getData(){
        var id = $("#idSala").val()
        var nombre = $("#nombreSala").val()
        return {id:id, nombre:nombre}
    }

    <?php if($SalaInstance instanceof Sala){ ?>
        //var root = document.getElementById("mapaSala1")
        function loadMapaSala(){
            console.log("xd")
            var mapaSala = <?=json_encode($SalaInstance->toArray()["mapaSala"]["asientos"])?>;
            console.log(mapaSala)
            //RenderSalaHTML(mapaSala)
        }
    <?php } ?>

</script>