<?php 
$title = "Votre mail - CDR Clim'Actions";
$description = "Votre mail";
ob_start(); ?>

<h1>Les emails</h1>

<div class="table-read-email">  
    <h3 class="table-title">Contenu de l'email</h3>
</div>

<div class="table-results">

    <ul id="read-email">
        <li class="username"><?= $readEmail["firstname"] . " " . $readEmail["lastname"] ?></li>
        <li class="object"><?= $readEmail["object"]?></li>
        <li class="content"><?= $readEmail["message"]?></li>
        <li class="created-at">Reçu le : <?= $readEmail["date"]?></li>
        <li class="view">Ouvert par : <?= $readEmail["prenom"]?> <?= $readEmail["nom"]?></li>
        <li class="btns">
            <span class="btn"><a href="indexAdmin.php?action=emailAdmin" rel="nofollow"><i class="fa-solid fa-arrow-left"></i></a></span>
            <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteEmail&id=<?= $readEmail['id'] ?>" rel="nofollow"><i class="fa-solid fa-trash-can"></i></a></span>
        </li>

    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>


