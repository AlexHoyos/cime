<?php

use CIME\Models\Clasificacion;

    include '../app/main.php';
    include '../app/Includes/Admin/Dashboard.php';
    $page = 1;
    if(isset($_GET["page"]))
        $page = intval($_GET["page"]);

    if($page == 0)
        $page = 1;

    $nextPageAdd = "";

    $orderBy = "ORDER BY id DESC";

    if(isset($_GET["orderby"])){
        switch($params["orderby"]){
            case "old":
                $orderBy = "ORDER BY id ASC";
                break;
            default:
                $orderBy = "ORDER BY id DESC";
        }
    }

    $condition = "";
    if(isset($_GET["search"])){
        $condition = "nombre LIKE \"%". $_GET["search"] ."%\"";
        $nextPageAdd .= '&search='.$_GET["search"];
    }
    $clasificacionesPagination = Clasificacion::getAll([], $condition, $orderBy);
    $clasificaciones = $clasificacionesPagination->page($page);
    $availablePages = $clasificacionesPagination->totalPages();
?>

<section class="d-flex flex-column justify-content-center align-items-center ms-2 mt-2 w-100" id="crud">
    <h2 class="super-title">Clasificaciones</h2>
    <article class="row m-0 d-0 w-100">

        <div class="col-6 col-md-4 ps-5">
            <form action="" method="get">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="search" placeholder="Busqueda" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-6 col-md-8 pl-5 d-flex flex-row justify-content-end">
            <button class="btn btn-primary">+ Crear</button>
        </div>

        <div class="col-12 d-flex flex-row justify-content-center">
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Niños</th>
                    <th scope="col">Adolescentes</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($clasificaciones as $clasificacion){
                    ?>
                    <tr>
                    <th scope="row"><?=$clasificacion["id"]?></th>
                    <td><?=$clasificacion["nombre"]?></td>
                    <td><?=$clasificacion["ninos"]?></td>
                    <td><?=$clasificacion["adolescentes"]?></td>
                    <td></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                    <a class="page-link" href="?page=<?=--$page?><?=$nextPageAdd?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                    </li>
                    <?php
                    for($i = 1; $i<=$availablePages; $i++){?>
                    <li class="page-item"><a class="page-link" href="?page=<?=$i?>"><?=$i?></a></li>
                    <?php } ?>
                    <li class="page-item">
                    <a class="page-link" href="?page=<?=++$page?><?=$nextPageAdd?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                    </li>
                </ul>
            </nav>
        </div>
    </article>
</section>

<?php
    include '../app/Includes/Admin/Footer.php';
?>
<script>

</script>