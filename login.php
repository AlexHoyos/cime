<?php

use CIME\Filters\SessionFilter;

    include './app/main.php';
    include './app/Includes/header.php';
    SessionFilter::noExistsUserSession();
?>

    <section class="row m-0 p-0" id="login">

        <div class="col-12" id="pageTitle">
            <h1>Iniciar Sesion</h1>
        </div>
    <div class="login-form">
        <div class="login-icon">
            <i class="fa-solid fa-key"></i>
        </div>
        <h2>Iniciar Sesión</h2>
        <p class="text-danger" id="error"></p>
        <form action="#" method="post" onsubmit="login(event)">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="correo" placeholder="Correo Electrónico" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" id="contra" placeholder="Contraseña" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <div class="form-group">
                <a href="/recuperacion.php?paso=1" class="forgot-password pull-right">¿Olvidaste tu Contraseña?</a>
            </div>        
        </form>
    </div>
    </section>

    <script src="assets/js/login.js"></script>
<?php
    include './app/Includes/footer.php';
?>