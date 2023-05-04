<?php

    include './app/main.php';
    include './app/Includes/header.php';
?>

<section class="row m-0 p-0" id="movie">

        <div class="col-11" id="pageTitle">
            <h1>Soy Fimeño</h1>
        </div>

        <div class="col-12 col-md-6 col-lg-4 div-img"
            style="min-height: 350px;background-image: url(<?=WEB_URL?>/app/Storage/fimeño.jpg);width: 250px;margin-left: 20px">
        </div>

        <div class="col-2 infopelicula">
            <h5 class="clasificacion">A+</h5>
            <h5 class="duracion"> 90 min</h5>
        </div>

        <div class="col-4 col-md-4 px-2 sinopsis">
            <h3>Sinopsis</h3>
            <p class="col-12 text-justify">
             Soy Fimeño trata de la vida del alumno Luis "Osito" Gutiérrez,
             un joven de 6to semestre  con 7 materias en 5ta, Luis se quiere rendir para cambiarse a FOD 
             pero un día mientras estaba perdido en el edificio 7,se encuentra con el espíritu de Colunga, 
             el cual lo motiva a seguir para que al final descubra que su casa siempre estará en FIME.
            </p>
        </div>

        <div class="calificacion1">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
        </div>

        <div class="col-11" id="pageTitle">
            <h1>Reseñas</h1>
        </div>

        <div class="col-6 reseña">
            <h5>Juan Perez</h5>
            <div class="calificacion2">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            </div>
            <p class="col-12 text-justify">
             La pelicula de Soy Fimeño estuvo increible, además de la experiencia en la sala fue muy satisfactoria
             fue un 10/10, super recomendado.
            </p>
        </div>

</section>

<?php
    include './app/Includes/footer.php';
?>