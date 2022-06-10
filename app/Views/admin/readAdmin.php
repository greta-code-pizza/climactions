<?php 
$title = "Vos utilisateurs - CDR Clim'Actions";
$description = "Vos utilisateurs";
ob_start(); ?>

<h1><?= $admin['firstname'] ." ". $admin['lastname'] ?></h1>

<div class="table-home">
    <h3 class="table-title">Prénom</h3>
    <h3 class="table-title">email</h3>
    <h3 class="table-title">Rôle</h3>
    <h3 class="table-title">Action</h3>
</div>

<!-- TO DO : Récupérer l'email grace à son ID -->

<div class="table-results">

    <ul class="table-item-home">
        <li class="username"><?= $admin['firstname'] ?></li>
        <!-- TO DO : faire une méthode getExcerpt -->
        <li><?= $admin['email'] ?></li>
        <li><?= $admin['role'] ?></li>
        <li class="flex">
            <span class="btn"><a href="indexAdmin.php?action=homeAdmin"><i class="fa-solid fa-arrow-left"></i></a></span>
            <?php if(isset($admin['role']) && ($admin['role'] == "Administrateur")) : ?>
            <span class="btn"><a href="indexAdmin.php?action=deleteAdmin&id=<?= $admin['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></span>
            <?php else : ?>
                <?php endif; ?>
        </li>

    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>