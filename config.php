<?php

use CIME\Filters\SessionFilter;
use CIME\Models\Usuario;

    include './app/main.php';
    include './app/Includes/header.php';
    SessionFilter::existsUserSession();
    $usuario = Usuario::getById(intval($_SESSION["uid"]));
?>

<section class="row m-0 p-0" id="register">

<div class="col-12" id="pageTitle">
    <h1>Configuración</h1>
</div>
<div class="login-form register-form">
    <div class="login-icon">
        <i class="fa-solid fa-gear"></i>
    </div>
    <p class="text-danger" id="error"></p>
    <p class="text-success" id="success"></p>
    <form action="javascript:void(0);" method="get">
        <div class="form-group my-2">
            <label for="contra" class="mx-2">La contraseña es necesaria para realizar cualquier cambio</label>
            <input type="password" class="form-control mx-2" name="contra" placeholder="Contraseña" id="contra" required="required">
        </div>
        <hr>
        <div class="form-group my-2">
            <label for="correo" class="mx-2">Correo electrónico</label>
            <input type="email" class="form-control mx-2" name="email" id="correo" placeholder="Correo Electronico" value="<?=$usuario->getCorreo()?>"
                required="required" disabled>
        </div>
        <div class="d-flex flex-row">
            <div class="form-group w-50 p-1">
                <label for="telefono">Telefono</label>
                <input type="number" class="form-control mx-2" name="telefono" id="telefono" placeholder="Telefono" required="required" value="<?=$usuario->getTelefono()?>" disabled>
            </div>
            <div class="form-group w-50 p-1">
                <label for="nacimiento">Fecha nacimiento</label>
                <input type="date" class="form-control mx-2" name="fechanacimiento" id="nacimiento" placeholder="Fecha de Nacimiento"
                    required="required" value="<?=$usuario->getNacimiento()?>" disabled>
            </div>
        </div>
        <hr>
        <p>Datos personales</p>
        <div class="input-group my-2">
            <input type="text" class="form-control mx-2" name="nombre" id="nombre" placeholder="Nombre" value="<?=$usuario->getNombre()?>">
            <input type="text" class="form-control mx-2" name="apellido" id="apellido" placeholder="Apellido" value="<?=$usuario->getApellido()?>">
        </div>
        <button class="btn btn-primary btn-block float-end" onclick="updatePersonalData()">Actualizar datos</button>
        <br><br>
        <hr>
        <p>Seguridad</p>
        <div class="input-group my-2">
            <input type="password" class="form-control mx-2" name="password" id="nueva_contra" placeholder="Constraseña Nueva">
            <input type="password" class="form-control mx-2" name="confirmpassword" id="repetir_contra" placeholder="Repite Contraseña">
        </div>
        <button class="btn btn-primary btn-block float-end" onclick="updatePassword()">Actualizar contraseña</button>
    </form>
</div>
</section>
<script src="assets/js/UserAccount/config_cuenta.js"></script>
<?php
    include './app/Includes/footer.php';
?>