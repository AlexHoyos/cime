<?php

use CIME\Filters\SessionFilter;

    include './app/main.php';
    include './app/Includes/header.php';
    SessionFilter::noExistsUserSession();
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
<p class="text-danger" id="error"></p>
<form action="#" onsubmit="irAPaso2(event)" method="post">
    <div class="form-group">
        <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo Electrónico" required="required">
    </div>
   
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block" id="sendCodeBtn">Enviar Código</button>
    </div>
     
</form>
</div>
</section>

    <?php } else if ($paso == 2 && isset($_GET["correo"])){ ?>
    
    <!-- PASO 2: SOLICITUD DE CODIGO Y CONTRA NUEVA -->
    <section class="row m-0 p-0" id="login">

        <div class="col-12" id="pageTitle">
            <h1>Recuperación</h1>
        </div>
    <div class="login-form">
        <div class="login-icon">
        <i class="fa-regular fa-circle-check"></i>
        </div>
        <h6>Se envío un código de verificacion a tu correo <?=$_GET["correo"]?></h6>
        <p class="text-danger" id="error"></p>
        <p class="text-success" id="success"></p>
        <form action="#" onsubmit="recuperacion(event)" method="post">
            <input type="hidden" name="correo" id="correo" value="<?=$_GET["correo"]?>">
            <div class="form-group">
                <input type="text" class="form-control" name="codigo" placeholder="Codigo" id="codigo" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Nueva Contraseña" id="contra" required="required">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Repite Contraseña" id="repetir_contra" required="required">
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
?>
<script src="assets/js/recuperacion.js"></script>
<script src="assets/js/utils.cime.js"></script>
<?php
    include './app/Includes/footer.php';

?>