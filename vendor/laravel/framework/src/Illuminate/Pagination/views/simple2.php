<?php
$presenter = new Illuminate\Pagination\BootstrapPresenter($paginator);
?>

<ul class="pag">
    <?php echo $presenter->render(); ?>
</ul>
<nav class="nav-paging">
    <ul>
        <?php echo $presenter->render(); ?>
    </ul>
</nav>
