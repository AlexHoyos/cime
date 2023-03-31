<?php

    include './app/main.php';
    include './app/Includes/header.php';
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
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Correo Electrónico" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Contraseña" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
            </div>
            <div class="form-group">
                <a href="#" class="forgot-password pull-right">¿Olvidaste tu Contraseña?</a>
            </div>        
        </form>
    </div>
    </section>

<?php
    include './app/Includes/footer.php';
?>