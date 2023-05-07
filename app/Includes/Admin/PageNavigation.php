<?php
    /**
     * @var page Contiene la página actual
     * @var nextPageAdd Contiene un string a añadir en los parametros GET 
     */
?>
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item">
        <a class="page-link" href="?page=<?=--$page?><?=$nextPageAdd?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
            <span class="sr-only">Previous</span>
        </a>
        </li>
        <?php
        $i = 1;
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