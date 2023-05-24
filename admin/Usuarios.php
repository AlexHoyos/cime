<?php

use CIME\Filters\CRUDPageFilter;
use CIME\Models\Clasificacion;
use CIME\Models\Rol;
use CIME\Models\Usuario;

    include '../app/main.php';
    include '../app/Includes/Admin/Dashboard.php';

    $page = CRUDPageFilter::getPageNumber();
    $orderBy = CRUDPageFilter::getOrderBy();
    $condition = CRUDPageFilter::getCondition("nombre");
    $correoSearch = CRUDPageFilter::getCondition("correo");
    if(!empty($correoSearch)){
        if(empty($condition))
            $condition = $correoSearch;
        else
            $condition.=" OR {$correoSearch} ";
    }

    $nextPageAdd = "";
    if(empty($condition) == false)
        $nextPageAdd .= '&search='.$_GET["search"];
    
    $usuariosPagination = Usuario::getAll([], $condition, $orderBy);
    $usuarios = $usuariosPagination->page($page);
    $availablePages = $usuariosPagination->totalPages();

?>


<section class="d-flex flex-column justify-content-center align-items-center ms-2 mt-2 w-100" id="crud">
    <h2 class="super-title">Usuarios</h2>
    <article class="row m-0 d-0 w-100">

    <?php 
        if(isset($_GET["id"])){

        $usuario = Usuario::getById(intval($_GET["id"]));
        if($usuario instanceof Usuario){
    ?>
        <div class="col-12 d-flex flex-column align-items-center justify-content-center py-3">
            <div class="card">
                <h5 class="card-header"><?=$usuario->getNombre()?> <?=$usuario->getApellido()?></h5>
                <div class="card-body">
                    <h5 class="card-title">Datos</h5>
                    <p>Correo: <b><?=$usuario->getCorreo()?></b></p>
                   <p>Telefono: <b><?=$usuario->getTelefono()?></b></p>
                   <p>Fecha nacimiento: <b><?=$usuario->getNacimiento()?></b> </p>
                   <p>Usuario desde: <b><?=$usuario->getRegDate()?></b></p>
                   <hr>
                   <b>Rol</b>
                   <select class="form-control" id="rol_id">
                    <?php
                    $roles = Rol::getAll()->showAll();
                    foreach($roles as $rol){
                        $rol = (object) $rol;
                        $isUserActualRol = $rol->id == $usuario->getRol()->getId();
                    ?>
                    <option value="<?=$rol->id?>" <?=($isUserActualRol)?"selected":""?> ><?=$rol->nombre?></option>
                    <?php } ?>
                   </select>
                   <button class="btn btn-warning my-1" onclick="saveRol(<?=$usuario->getId()?>, document.getElementById('rol_id').value)">Guardar rol</button>
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

        <div class="col-12 d-flex flex-row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($usuarios as $usuario){
                        $usuario = (object) $usuario;
                    ?>
                    <tr>
                        <th scope="row"><?=$usuario->id?></th>
                        <td><?=$usuario->nombre?> <?=$usuario->apellido?></td>
                        <td><?=$usuario->correo?></td>
                        <td><?=$usuario->telefono?></td>
                        <td>
                            <a href="?id=<?=$usuario->id?>" class="btn btn-success">Ver</a>
                            <button class="btn btn-danger" onclick="deleteObject(<?=$usuario->id?>)">Eliminar</button>
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

    function saveRol(id, rol_id){
        $.ajax({
            type: "PUT",
            url: '../app/Controllers/CRUD/Usuarios.php',
            data: {id:id, rol_id:rol_id},
            success: function(response)
            {

                alert("Usuario actualizado!");
                window.location.reload()
            },
            error: function(response){
                
                console.log(response)
                alert("Error al actualizar al usuario")
                alert(response.responseJSON.error)
            }
       });
    }
    function deleteObject(id){
        $.ajax({
            type: "DELETE",
            url: '../app/Controllers/CRUD/Usuarios.php',
            data: {id:id},
            success: function(response)
            {

                alert("Usuario eliminado!");
                window.location.reload()
            },
            error: function(response){
                console.log(response)
                alert("Error al eliminar al usuario")
            }
       });
    }
</script>