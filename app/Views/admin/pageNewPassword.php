<?php 
$title = "Votre nouveau mot de passe - CDR Clim'Actions";
$description = "Votre nouveau mot de passe";
ob_start(); ?>
<?php //$admin = $mdpAdmin->fetch() ?>

<section id="section-NewPassword">

    <h1>Nouveau Mot de passe</h1>

    <form action="indexAdmin.php?action=newPasswordPost&id=<?= $_SESSION['id'] ?>" method="POST">
        <?php if (isset($erreur)):
                if($erreur): 
                    foreach($erreur as $e):
                    ?>
        <p class="msg-error"><?= $e ?></p>
        <?php
                endforeach;
                endif;
            endif;
            ?>

        <div>
            <label for="oldPassword">Ancien mot de passe:</label>
            <input type="password" name="oldPassword" id="oldPassword" required />
        </div>
        <div>
            <label for="newPassword">Votre nouveau mot de passe:</label>
            <input type="password" name="newPassword" id="newPassword" required />
        </div>
        <div>
            <label for="passwordConfirm">Confirmation mot de passe:</label>
            <input type="password" name="passwordConfirm" id="passwordConfirm" required />
        </div>

        <button class="btnChangePsw" type="submit">Changer</button>
        <a href="indexAdmin.php?action=accountAdmin&id=<?= $_SESSION['id'] ?>">Retour</a>
    </form>


</section>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>