<?php

    include './app/main.php';
    include './app/Includes/header.php';
?>

    <section class="row m-0 p-0" id="contacto">

        <div class="col-12" id="pageTitle">
            <h1>Contacto</h1>
        </div>

        <article class="col-12 col-md-7 px-3 py-2 d-flex flex-column justify-content-center">
            <form class="w-100">
                <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="text" class="form-control" id="nombre" required>
                </div>
                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje</label>
                    <textarea class="form-control" id="mensaje" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary mt-1">Enviar</button>
            </form>
        </article>

        <div class="col-12 col-md-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5830.693668881422!2d-100.31538421287495!3d25.724295249742713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x86629452551ea79f%3A0x66e03550ec5730cb!2sFacultad%20de%20Ingenier%C3%ADa%20Mec%C3%A1nica%20y%20El%C3%A9ctrica!5e0!3m2!1ses-419!2smx!4v1678648434956!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <br>
            <p>Telefono: 8100000000.</p>
            <p>Horario: Todos los días de 10:00 am a 12:00 am</p>      
        </div>

    </section>

<?php
    include './app/Includes/footer.php';
?>