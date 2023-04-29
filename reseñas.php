<?php

include './app/main.php';
include './app/Includes/header.php';

?>

<section class="row m-0 p-0" id="reseña">

    <div class="col-12" id="pageTitle">
        <h1>Reseña</h1>
    </div>
    <div class="login-form">
        <h2>¿Que te parecio la pelicula Soy Fimeño?</h2>
        <div class="login-icon">
            <i class="fas fa-star"></i>
        </div>
        <p class="text-danger" id="error"></p>
        <p class="col-4">Escribe una pequeña reseña sobre tu experencia y opinion sobre la pelicula,
            evita hacer mal uso de esta seccion. Toda abuso sera sancionado.</p>
        <form action="#" method="post">
            <div class="form-group">
                <textarea class="form-control" id="reseña" placeholder="Escribe tu opinion..."></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Enviar Reseña</button>
            </div>
        </form>
    </div>
</section>
<?php
include './app/Includes/footer.php';
?>