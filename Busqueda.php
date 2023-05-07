<?php

include './app/main.php';
include './app/Includes/header.php';
?>

<section class="row m-0 p-0" id="SearchMovie">
    <div class="col-11" id="pageTitle">
        <h1>Busqueda</h1>
        <h5>Resultados para "FIME"</h5>
    </div>
    <article class="row col-12 px-4">
        

        <div class="col-12 d-flex flex-row">
            <div class="d-flex flex-column">
                <div class="col-12 col-md-6 col-lg-4 div-img m-1"
                    style="min-height: 350px;background-image: url(/app/Storage/peliculas/poster_1682308028SuperMarioBros6445fbbc9e0b0.jpg);width: 250px;margin-left: 20px;cursor:pointer;">
                </div>
                <div>
                    <div class="login-icon" style="font-size:18px">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                </div>
            </div>

            <div class="d-flex flex-column">
                <h4>Super Mario Bros
                    <span class="badge bg-dark text-light">A+</span>
                    <span class="badge bg-dark text-light">90 min</span>
                </h4>
                <div class="mx-1" style="max-width:500px">
                    <p class="col-12 col-md-6 col-lg-8 text-justify">
                        Soy Fimeño trata de la vida del alumno Luis "Osito" Gutiérrez, un joven de 6to semestre con 7 materias
                        en 5ta,
                        Luis se quiere rendir para cambiarse a FOD pero un día mientras estaba perdido en el edificio 7,
                        se encuentra con el espíritu de Colunga, el cual lo motiva a seguir para que al final descubra
                        que su casa siempre estará en FIME.
                    </p>
                </div>
            </div>
        </div>

        <hr>

    </article>
</section>
<?php

include './app/Includes/footer.php';

?>