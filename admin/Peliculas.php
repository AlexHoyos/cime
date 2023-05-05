<?php

use CIME\Filters\CRUDPageFilter;
use CIME\Models\Clasificacion;
use CIME\Models\Pelicula;

    include '../app/main.php';
    include '../app/Includes/Admin/Dashboard.php';

    $page = CRUDPageFilter::getPageNumber();
    $orderBy = CRUDPageFilter::getOrderBy();
    $condition = CRUDPageFilter::getCondition("titulo");

    $nextPageAdd = "";
    if(empty($condition) == false)
        $nextPageAdd .= '&search='.$_GET["search"];
    
    $pelisPagination = Pelicula::getAll([], $condition, $orderBy);
    $peliculas = $pelisPagination->page($page);
    $availablePages = $pelisPagination->totalPages();

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
        <input type="hidden" id="idPelicula">
        <label for="nombre">Titulo:</label>
        <input type="text" name="titulo" id="tituloPelicula" placeholder="Titulo" class="form-control">
        <label for="descripcion">Sipnosis:</label>
        <textarea name="sinopsis" id="sinopsisPelicula" placeholder="Sinopsis" class="form-control"></textarea>
        <label for="anio">Año:</label>
        <input type="number" name="anio" id="anioPelicula" placeholder="Año" class="form-control">
        <label for="duracion">Duración:</label>
        <input type="number" name="duracion" id="duracionPelicula" placeholder="Duración en minutos" class="form-control">
        <label for="clasificacionn">Clasificacion</label>
        <select name="clasificacion" id="clasificacionPelicula" class="form-control">
            <option value="0" selected disabled>--- SELECCIONAR UNA OPCION ---</option>
            <?php
            $clasificaciones = Clasificacion::getAll()->showAll();
            foreach($clasificaciones as $clasificacion){
            ?>
            <option value="<?=$clasificacion["id"]?>"><?=$clasificacion["nombre"]?> - <?=$clasificacion["descripcion"]?></option>
            <?php } ?>
        </select>
        <label for="poster">Poster</label>
        <input type="file" name="poster" id="posterPelicula" class="form-control" onchange="mostrarImage('posterPelicula', 'examplePoster')">
        <div class="poster-img" id="examplePoster"></div>
        <label for="wallpaper">Wallpaper (opcional)</label>
        <input type="file" name="wallpaper" id="wallpaperPelicula" class="form-control" onchange="mostrarImage('wallpaperPelicula', 'exampleWallpaper')">
        <div class="wallpaper-img" style="width:500px; height:200px" id="exampleWallpaper"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="saveBtn">Guardar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
      </div>
    </div>
  </div>
</div>

<section class="d-flex flex-column justify-content-center align-items-center ms-2 mt-2 w-100" id="crud">
    <h2 class="super-title">Peliculas</h2>
    <article class="row m-0 d-0 w-100">

    <?php 
        if(isset($_GET["id"])){

        $peli = Pelicula::getById(intval($_GET["id"]));
        if($peli instanceof Pelicula){
            
    ?>
        <div class="col-12 d-flex flex-column align-items-center justify-content-center py-3">
            <div class="card w-100">
                <h5 class="card-header">
                    <?=$peli->getTitulo()?>
                    <span class="badge bg-secondary"><?=$peli->getClasificacionInstance()->getNombre()?></span>
                    <span class="badge bg-dark"><?=$peli->getDuracion()?> min</span>
                </h5>
                <div class="card-body row">
                    <div class="col-12 col-md-4 d-flex flex-row justify-content-center">
                        <div class="poster-img" style="background-image:url(../app/Storage/peliculas/<?=$peli->getPortada()?>)"></div>
                    </div>
                    <div class="col-12 col-md-8">
                        <h5 class="card-title"><b>Sinopsis</b></h5>
                        <p class="card-text"><?=$peli->getSinopsis()?></p>
                    </div>
                    <div class="col-12 d-flex flex-row justify-content-center">
                        <a href="#" class="btn btn-outline-secondary">Ir a página</a>
                        <button class="btn btn-outline-secondary mx-2" onclick="openEdit(<?=$peli->getId()?>)">Editar</button>
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
            <button class="btn btn-primary" onclick="openAdd()">+ Crear</button>
        </div>

        <div class="col-12 d-flex flex-row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Año</th>
                    <th scope="col">Clasificación</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($peliculas as $peliculaRow){
                        $pelicula = Pelicula::transformRow((object) $peliculaRow);
                        $clasificacionInstance = $pelicula->getClasificacionInstance();
                        $clasificacion = "";
                        if($clasificacionInstance instanceof Clasificacion)
                            $clasificacion = $clasificacionInstance->getNombre();
                    ?>
                    <tr>
                        <th scope="row"><?=$pelicula->getId()?></th>
                        <td><?=$pelicula->getTitulo()?></td>
                        <td><?=$pelicula->getAnio()?></td>
                        <td><?=$clasificacion?></td>
                        <td>
                            <a href="?id=<?=$pelicula->getId()?>" class="btn btn-success">Ver</a>
                            <button class="btn btn-warning" onclick="openEdit(<?=$pelicula->getId()?>)">Editar</button>
                            <button class="btn btn-danger" onclick="deleteObject(<?=$pelicula->getId()?>)">Eliminar</button>
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
            url: '../app/Controllers/CRUD/Peliculas.php?id='+id,
            data: {},
            success: function(response)
            {
                console.log(response)
                $("#idPelicula").val(response.id)
                $("#tituloPelicula").val(response.titulo)
                $("#anioPelicula").val(response.anio)
                $("#sinopsisPelicula").val(response.sinopsis)
                $("#duracionPelicula").val(response.duracion)
                $("#clasificacionPelicula").val(response.id_clasificacion)
                $("#examplePoster").css("background-image", "url(../app/Storage/peliculas/"+response.portada+")")
                $("#exampleWallpaper").css("background-image", "url(../app/Storage/peliculas/"+response.wallpaper+")")
                $("#saveBtn").attr('onclick', 'edit()')
                openModal()
            },
            error: function(res){
                console.log(res)
            }
       });
    }

    function openAdd(){
        $("#idPelicula").val("")
        $("#tituloPelicula").val("")
        $("#anioPelicula").val("")
        $("#sinopsisPelicula").val("")
        $("#duracionPelicula").val("")
        $("#clasificacionPelicula").val(0)
        $("#saveBtn").attr('onclick', 'edit()')
        openModal()
    }

    function mostrarImage(id_input, id_div){
        var input = document.getElementById(id_input);

        if(input.files && input.files[0]) {
            if (input.files && input.files[0]) { //Revisamos que el input tenga contenido
                var reader = new FileReader(); //Leemos el contenido
                
                reader.onload = function(e) { //Al cargar el contenido lo pasamos como atributo de la imagen de arriba
                    //$('#'+id_div).attr('src', e.target.result);
                    console.log(e.target.result)
                    $('#'+id_div).css("background-image", "url("+e.target.result+")")
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }

    }

    function add(){
       
        var data = getFormData()

        $.ajax({
            type: "POST",
            url: '../app/Controllers/CRUD/Peliculas.php',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success: function(response)
            {
                alert("Pelicula agregada!");
                window.location.reload()
            },
            error: function(response){
                console.log(data)
                console.log(response)
            }
       });
    }

    function edit(){
        var data = getFormData()
        data.append('isPUT', true)
        $.ajax({
            type: "POST",
            url: '../app/Controllers/CRUD/Peliculas.php',
            data: data,
            processData: false,  // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success: function(response)
            {
                alert("Pelicula actualizada!");
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
            url: '../app/Controllers/CRUD/Peliculas.php',
            data: {id:id},
            success: function(response)
            {

                alert("Pelicula eliminada!");
                window.location.reload()
            },
            error: function(response){
                console.log(response)
            }
       });
    }

    function getFormData(){
        var id = $("#idPelicula").val()
        var titulo = $("#tituloPelicula").val()
        var anio = $("#anioPelicula").val()
        var sinopsis = $("#sinopsisPelicula").val()
        var duracion = $("#duracionPelicula").val()
        var clasificacion = $("#clasificacionPelicula").val()
        var poster = null
        var wallpaper = null
        var data = new FormData();

        if(document.getElementById('posterPelicula').files.length > 0)
            poster = document.getElementById('posterPelicula').files[0]
        
        if(document.getElementById('wallpaperPelicula').files.length > 0)
            wallpaper = document.getElementById('wallpaperPelicula').files[0]
        
        data.append('id', id)
        data.append('titulo', titulo)
        data.append('anio', anio)
        data.append('sinopsis', sinopsis)
        data.append('duracion', duracion)
        data.append('clasificacion', clasificacion)
        if(poster != null)
            data.append('poster', poster)
        if(wallpaper != null)
            data.append('wallpaper', wallpaper)

        return data
    }

</script>