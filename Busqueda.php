<?php
include './app/main.php';
include './app/Includes/header.php';
?>

<section class="row m-0 p-0" id="SearchMovie">
    <div class="col-11" id="pageTitle">
        <h1>Busqueda</h1>
        <h2>Resultados para "FIME"</h2>
    </div>
    <article class="row col-12 px-4">
        <div class="poster">
        </div>
        <div class="info-pelicula1">
            <h3 id="nompeli">Soy Fimeño</h3>
            <h5 id="clasificacionpeli">A+</h5>
            <h5 id="duracionpeli">90 min</h5>
        </div>
        <div class="descripcion-pelicula1">
            <p class="col-12 col-md-6 col-lg-8 text-justify">
                Soy Fimeño trata de la vida del alumno Luis "Osito" Gutiérrez, un joven de 6to semestre con 7 materias
                en 5ta,
                Luis se quiere rendir para cambiarse a FOD pero un día mientras estaba perdido en el edificio 7,
                se encuentra con el espíritu de Colunga, el cual lo motiva a seguir para que al final descubra
                que su casa siempre estará en FIME.
            </p>
        </div>
        <div class="container">
            <div class="star-widget">
                <input type="radio" name="rate" id="rate-5">
                <label for="rate-5" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-4">
                <label for="rate-4" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-3">
                <label for="rate-3" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-2">
                <label for="rate-2" class="fas fa-star"></label>
                <input type="radio" name="rate" id="rate-1">
                <label for="rate-1" class="fas fa-star"></label>
            </div>
        </div>
    </article>
</section>
<?php
    include './app/Includes/footer.php';
?>