<?php

    include './app/main.php';
    include './app/Includes/header.php';
?>
<section class="row m-0 p-0" id="register">

<div class="col-12" id="pageTitle">
    <h1>Registro</h1>
</div>
<div class="register-form">
<div class="register-icon">
<i class="fa-solid fa-users-viewfinder"></i>
</div>
<h2>Registro</h2>
<form action="register.php" method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="nombre" placeholder="Nombre (s)" required="required">
    </div>
    <div class="form-group">
        <input type="text" class="form-control" name="apellido" placeholder="Apellido" required="required">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Correo Electronico" required="required">
    </div>
    <div class="form-group">
        <input type="number" class="form-control" name="telefono" placeholder="Telefono" required="required">
    </div>
    <div class="form-group">
        <input type="date" class="form-control" name="fechanacimiento" placeholder="Fecha de Nacimiento" required="required">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Constraseña" required="required">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="confirmpassword" placeholder="Repite Contraseña" required="required">
    </div>
    <div class="imgcaptcha">
        <img src="<?=WEB_URL?>/app/Includes/CaptchaImg.php" height="90px" width="120px">
    </div>
    <div class="form-group">
        <input type="checkbox" class="form-control" name="condiciones"  required="required">
        <label for="condiciones"> Acepto los terminos y condiciones</label>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Registrarme</button>
    </div>       
</form>
</div>
</section>

<?php
    include './app/Includes/footer.php';
?>