<?php

    include './app/main.php';
    include './app/Includes/header.php';

    if(isset($_GET["paso"])){

        $paso = intval($_GET["paso"]);

        if($paso >= 1 && $paso <= 2){

            if($paso == 1){
?>

    <!-- PASO 1: SOLICITUD DEL CORREO -->
    <section class="row m-0 p-0" id="login">

<div class="col-12" id="pageTitle">
    <h1>Recuperación</h1>
</div>
<div class="login-form">
<div class="login-icon">
    <i class="fa-solid fa-key"></i>
</div>
<h6>Se enviara un código de autenticacion a tu correo electrónico</h6>
<form action="login.php" method="post">
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Correo Electrónico" required="required">
    </div>
   
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Enviar Código</button>
    </div>
     
</form>
</div>
</section>

    <?php } else { ?>
    
    <!-- PASO 2: SOLICITUD DE CODIGO Y CONTRA NUEVA -->
    <section class="row m-0 p-0" id="login">

        <div class="col-12" id="pageTitle">
            <h1>Recuperación</h1>
        </div>
    <div class="login-form">
        <div class="login-icon">
        <i class="fa-regular fa-circle-check"></i>
        </div>
        <h6>Se envío un código de verificacion a tu correo example@example.com</h6>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Codigo" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Nueva Contraseña" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Repite Contraseña" required="required">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Cambiar Contraseña</button>
            </div>
                  
        </form>
    </div>
    </section>

<?php
    }
        } else {
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
    }

    include './app/Includes/footer.php';

?>