<?php 
$title = "Votre Dashboard - CDR Clim'Actions";
$description = "Votre dashboard";
ob_start(); ?>

<h1>Bienvenue</h1>

<div class="table-home">
    <h3 class="table-title">Prénom</h3>
    <h3 class="table-title">email</h3>
    <h3 class="table-title">Rôle</h3>
    <h3 class="table-title">Action</h3>
</div>

<?php foreach($listAdmin as $admin) : ?>

<div class="table-results">

    <ul class="table-item-home">
        <li><?= $admin['firstname'] ?></li>
        <li><?= $admin['email'] ?></li>
        <li><?= $admin['role'] ?></li>
        <li class="flex">
            <span class="btn"><a href="indexAdmin.php?action=readAdmin&id=<?= $admin['id'] ?>"><i class="fa-solid fa-eye"></a></i></span>
            <?php if(isset($admin['role']) && ($admin['role'] == "Administrateur")) : ?>
            <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteAdmin&id=<?= $admin['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></span>
            <?php else : ?>
                <?php endif; ?>
        </li>
    </ul>
</div>

<?php endforeach ?>

<div>
    <a class="btn-create" href="indexAdmin.php?action=pageCreationAdmin">Créer</a>
</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>