<?php

include '../app/main.php';
include '../app/Includes/Admin/Dashboard.php';

?>
   <div class="d-flex flex-column w-100">
        <h4 class="p-4">Bienvenido, <?=$admin->getNombre()?></h4>
        <div class="d-flex flex-column w-100 vh-100 justify-content-center align-items-center p-4" id="inicio">

            

            <div class="d-flex flex-row">
                <a href="<?=WEB_URL?>/admin/cartelera.php" class="btn mx-2 btn-primary p-5">
                    <h3>VENTA BOLETOS</h3>
                </a>
                <a href="<?=WEB_URL?>/admin/escaner.php" class="btn mx-2 btn-warning p-5">
                    <h3>ESCANER BOLETOS</h3>
                </a>
            </div>

        </div>
   </div>

    <?php
    include '../app/Includes/Admin/Footer.php';
    ?>
    </body>
</html>

