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
        <li><?= $readEmail["object"]?></li>
        <li><?= $readEmail["message"]?></li>
        <li>Reçu le : <?= $readEmail["date"]?></li>
        <li>Ouvert par : <?= $readEmail["prenom"]?> <?= $readEmail["nom"]?></li>
        <li>
            <span class="btn"><a href="indexAdmin.php?action=emailAdmin"><i class="fa-solid fa-arrow-left"></i></a></span>
            <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteEmail&id=<?= $readEmail['id'] ?>"><i class="fa-solid fa-trash-can"></i></a></span>
        </li>

    </ul>
</div>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>