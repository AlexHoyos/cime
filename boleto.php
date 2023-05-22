<?php
    include './app/main.php';
    include './app/Includes/header.php';
?>

<section class="row m-0 p-0" id="aboutUs">
    <div class="col-11" id="pageTitle">
        <h1>Boleto</h1>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-md-6 col-lg-4 div-img" style="min-height: 300px; background-image: url(<?=WEB_URL?>/app/Storage/aboutus/perrito.jpg)"></div>
                    <div class="col-md-6 col-lg-8">
                        <h2>Película: [Nombre de la película]</h2>
                        <p>Formato: [Formato de la película]</p>
                        <p>Idioma: [Idioma de la película]</p>
                        <p>Día: [Día de la función]</p>
                        <p>Hora: [Hora de la función]</p>
                        <p>Sala: [Número de sala]</p>
                        <p>Asientos: [Lista de asientos seleccionados]</p>
                    </div>
                </div>
                <h3>BOLETOS</h3>
                <p>Adultos: [Cantidad de adultos]</p>
                <p>Estudiantes: [Cantidad de estudiantes]</p>
                <p>Niños: [Cantidad de niños]</p>
                <p>Total pagado: [Total pagado]</p>
            </div>
            <div class="col-lg-6">
                <div class="row justify-content-end">
                    <div class="col-lg-6 text-right">
                        <img src="aqui" alt="Código QR" class="img-fluid mb-3">
                        <p class="codigo-texto">Código: [Código QR]</p>
                    </div>
                </div>
                <div class="col-lg-3 d-flex align-items-start justify-content-center mt-3" style="margin-top: -30px;">
                    <div class="boletos-info text-center">
                        <div class="boletos">
                            <div class="boletos-item">
                                <i class="fa-solid fa-user"></i>
                                <p>X3</p>
                            </div>
                            <div class="boletos-item">
                                <i class="fa-solid fa-user-graduate"></i>
                                <p>X1</p>
                            </div>
                            <div class="boletos-item">
                                <i class="fa-solid fa-child"></i>
                                <p>X2</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <p class="disfrute-mensaje"><h1>¡Disfrute su función!<h1></p>
            </div>
        </div>
    </div>
</section>

<?php
    include './app/Includes/footer.php';
?>
