<?php

use CIME\Filters\SessionFilter;

include './app/main.php';
include './app/Includes/header.php';

SessionFilter::noExistsUserSession();

?>
<section class="row m-0 p-0" id="register">

    <div class="col-12" id="pageTitle">
        <h1>Registro</h1>
    </div>
    <div class="login-form register-form">
        <div class="login-icon">
            <i class="fa-solid fa-users-viewfinder"></i>
        </div>
        <p class="text-danger" id="error"></p>
        <form action="#" method="post" onsubmit="register(event)">
            <div class="input-group my-2">
                <input type="text" class="form-control mx-2" name="nombre" placeholder="Nombre (s)" id="nombre" required="required">
                <input type="text" class="form-control mx-2" name="apellido" placeholder="Apellido" id="apellido" required="required">
            </div>
            <div class="input-group my-2">
                <input type="email" class="form-control mx-2" name="email" id="correo" placeholder="Correo Electronico"
                    required="required">
            </div>
            <div class="input-group my-2">
                <input type="number" class="form-control mx-2" name="telefono" id="telefono" placeholder="Telefono" required="required">
                <input type="date" class="form-control mx-2" name="fechanacimiento" id="nacimiento" placeholder="Fecha de Nacimiento"
                    required="required">
            </div>
            <div class="input-group my-2">
                <input type="password" class="form-control mx-2" name="password" id="contra" placeholder="Constraseña"
                    required="required">
                <input type="password" class="form-control mx-2" name="confirmpassword" id="repetir_contra" placeholder="Repite Contraseña"
                    required="required">
            </div>
            <div class="input-group my-2 ps-2">
                <img src="<?= WEB_URL ?>/app/Includes/CaptchaImg.php" width="120px">
                <input type="text" class="form-control mx-2" name="captcha" placeholder="Texto en la imagen" id="captcha"
                    required="required">
            </div>
            <div class="d-flex flex-row justify-content-around px-2 my-2">
                <div class="input-group">
                    <input type="checkbox" class="form-check-input" name="condiciones" id="condiciones" value="condicion">
                    <label for="condiciones" class="ms-1"> Acepto los terminos y condiciones</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block float-end">Registrarme</button>
            </div>
        </form>
    </div>
</section>

<script src="assets/js/login.js"></script>
<script src="assets/js/register.js"></script>
<?php
include './app/Includes/footer.php';
?>