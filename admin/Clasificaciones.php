<?php

use CIME\Filters\CRUDPageFilter;
use CIME\Models\Clasificacion;

    include '../app/main.php';
    include '../app/Includes/Admin/Dashboard.php';

    $page = CRUDPageFilter::getPageNumber();
    $orderBy = CRUDPageFilter::getOrderBy();
    $condition = CRUDPageFilter::getCondition("nombre");

    $nextPageAdd = "";
    if(empty($condition) == false)
        $nextPageAdd .= '&search='.$_GET["search"];
    
    $clasificacionesPagination = Clasificacion::getAll([], $condition, $orderBy);
    $clasificaciones = $clasificacionesPagination->page($page);
    $availablePages = $clasificacionesPagination->totalPages();

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
        <input type="hidden" id="idClasificacion">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombreClasificacion" placeholder="Nombre" class="form-control">
        <label for="descripcion">Descripcion:</label>
        <textarea name="descripcion" id="descripcionClasificacion" placeholder="Descripcion" class="form-control"></textarea>
        <label>Se permite niños:</label><br>
        <input type="radio" name="ninos" id="siNinos" value="s"><label for="siNinos">Sí</label>
        <input type="radio" name="ninos" id="noNinos" value="n"><label for="noNinos">No</label>
        <br>
        <label for="nombre">Se permite adolescentes:</label><br>
        <input type="radio" name="adols" id="siAdols" value="s"><label for="siAdols">Sí</label>
        <input type="radio" name="adols" id="adultsAdols" value="adult"><label for="adultsAdols">Acompañados de un adulto</label>
        <input type="radio" name="adols" id="noAdols" value="n"><label for="noAdols">No</label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveBtn">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<section class="d-flex flex-column justify-content-center align-items-center ms-2 mt-2 w-100" id="crud">
    <h2 class="super-title">Clasificaciones</h2>
    <article class="row m-0 d-0 w-100">

    <?php 
        if(isset($_GET["id"])){

        $clasificacion = Clasificacion::getById(intval($_GET["id"]));
        if($clasificacion instanceof Clasificacion){
    ?>
        <div class="col-12 d-flex flex-column align-items-center justify-content-center py-3">
            <div class="card">
                <h5 class="card-header"><?=$clasificacion->getNombre()?></h5>
                <div class="card-body">
                    <h5 class="card-title">Descripción</h5>
                    <p class="card-text"><?=$clasificacion->getDescripcion()?></p>
                    <span class="badge bg-success"><?=($clasificacion->isForNinos()) ? 'Niños': ''?></span>
                    <span class="badge bg-success"><?=($clasificacion->isForAdolescentes()) ? 'Adolescentes': ''?></span>
                    <span class="badge bg-warning"><?=($clasificacion->isForAdolAdult()) ? 'Adolescentes acompañados de un adulto': ''?></span>
                    <span class="badge bg-danger"><?=($clasificacion->isForAdolescentes() == false && $clasificacion->isForNinos() == false && $clasificacion->isForAdolAdult() == false) ? 'Solo adultos': ''?></span>
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
                    <th scope="col">Niños</th>
                    <th scope="col">Adolescentes</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($clasificaciones as $clasificacion){
                        $ninos = "no";
                        $adol = "no";
                        if($clasificacion["ninos"]){ $ninos = "si"; }
                        if($clasificacion["adolescentes"]){ $adol = "si"; }
                        if($clasificacion["adol_adult"]){ $adol = "Con Adulto"; }
                    ?>
                    <tr>
                        <th scope="row"><?=$clasificacion["id"]?></th>
                        <td><?=$clasificacion["nombre"]?></td>
                        <td><?=$ninos?></td>
                        <td><?=$adol?></td>
                        <td>
                            <a href="?id=<?=$clasificacion["id"]?>" class="btn btn-success">Ver</a>
                            <button class="btn btn-warning" onclick="openEdit(<?=$clasificacion['id']?>)">Editar</button>
                            <button class="btn btn-danger" onclick="deleteObject(<?=$clasificacion['id']?>)">Eliminar</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                    <a class="page-link" href="?page=<?=--$page?><?=$nextPageAdd?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <?php
                    for($i = 1; $i<=$availablePages; $i++){?>
                    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                    <li class="page-item">
                    <a class="page-link" href="?page=<?=++$page?><?=$nextPageAdd?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
            </nav>
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

    function hideModal(){
        $("#objectModal").modal('hide')
    }

    function openEdit(id){
        $.ajax({
            type: "GET",
            url: '../app/Controllers/CRUD/Clasificaciones.php?id='+id,
            data: {},
            success: function(response)
            {
                console.log(response)
                $("#idClasificacion").val(id)
                $("#nombreClasificacion").val(response.nombre)
                $("#descripcionClasificacion").val(response.descripcion)
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
        var nombre = $("#nombreClasificacion").val()
        var descripcion = $("#descripcionClasificacion").val()
        var ninos = $("input[name='ninos']:checked").val();
        var adols = $("input[name='adols']:checked").val();
        $.ajax({
            type: "POST",
            url: '../app/Controllers/CRUD/Clasificaciones.php',
            data: {nombre:nombre, descripcion:descripcion, ninos:ninos, adols:adols},
            success: function(response)
            {

                alert("Clasificacion agregada!");
                window.location.reload()
            },
            error: function(response){
                console.log({nombre:nombre, descripcion:descripcion, ninos:ninos, adols:adols})
                console.log(response)
            }
       });
    }

    function edit(){
        var id = $("#idClasificacion").val()
        var nombre = $("#nombreClasificacion").val()
        var descripcion = $("#descripcionClasificacion").val()
        var ninos = $("input[name='ninos']:checked").val();
        var adols = $("input[name='adols']:checked").val();
        $.ajax({
            type: "PUT",
            url: '../app/Controllers/CRUD/Clasificaciones.php',
            data: {id:id, nombre:nombre, descripcion:descripcion, ninos:ninos, adols:adols},
            success: function(response)
            {

                alert("Clasificacion editada!");
                window.location.reload()
            },
            error: function(response){
                console.log({id:id, nombre:nombre, descripcion:descripcion, ninos:ninos, adols:adols})
                console.log(response)
            }
       });
    }
    function deleteObject(id){
        $.ajax({
            type: "DELETE",
            url: '../app/Controllers/CRUD/Clasificaciones.php',
            data: {id:id},
            success: function(response)
            {

                alert("Clasificacion eliminada!");
                window.location.reload()
            },
            error: function(response){
                console.log(response)
            }
       });
    }
</script>