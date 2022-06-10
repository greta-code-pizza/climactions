<?php 
$title = "Votre compte utilisateur - CDR Clim'Actions";
$description = "Votre compte utilisateur";
ob_start(); ?>

<section id="pageAccount">
<h1>Bonjour <?= $_SESSION['firstname']. " ". $_SESSION['lastname'] ?>!</h1>

<p>Votre Email: <?= $_SESSION['email'] ?></p>

<a class="changePassword" href="indexAdmin.php?action=pageNewPassword&id=<?= $_SESSION['id'] ?>">Changer votre mot de passe</a>

</section>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>

