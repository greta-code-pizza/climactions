<?php 
$title = "Le Carnet d'Adresses - CDR Clim'Actions";
$description = "Le Carnet d'Adresses";
ob_start(); ?>

<h1>Carnet d'adresses</h1>

<?php
require_once "app/Views/admin/layouts/searchAddress.php";
?>

<div class="table-addressBook">
    <h3 class="table-title-addressBook">Prénom et Nom</h3>
    <h3 class="table-title-addressBook">Email</h3>
    <h3 class="table-title-addressBook">Action</h3>
</div>

<div class="bg">
    <?php foreach ($infos as $info) { ?>
    <div class="table-results">
        <ul class="table-item-addressBook">
            <li><?= $info["firstname"] . " " . $info["lastname"] ?></li>
            <li><?= $info["email"]?></li>


            <!-- L'élément HTML <dialog> représente une boite de dialogue ou un composant interactif -->
            <dialog class="favDialog">

                <form method="dialog"></form>

                <p>Voulez-vous supprimer ?</p>

                <!-- L'élément HTML <menu> représente un groupe de commandes que l'utilisateur peut utiliser ou activer. Il
                    peut être utilisé afin de créer des menus (affichés en haut d'un écran par exemple) et des menus
                    contextuels (qui apparaissent au clic-droit ou après avoir cliqué sur un bouton). -->
                <menu>
                    <button class="cancelBtn">Annuler</button>
                    <button class="confirmBtn" value="default">Confirmer</button>
                </menu>

                </form>

            </dialog>

            <li>

                <menu>
                    <!-- <span class="btn"><a id="delete" href="indexAdmin.php?action=deleteInfo&id=<?= $info['id'] ?>"><i
                                class="fa-solid fa-trash-can"></i></a></span> -->
                    <button class="delete" data-id="<?= $info['id'] ?>">SUP</button>
                </menu>

                <!-- L'élément HTML <output> représente un conteneur dans lequel un site ou une application peut injecter le résultat d'un calcul ou d'une action utilisateur. --> 
                <output aria-live="polite"></output>
        </ul>
    </div>
    <?php }; ?>
</div>
<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>




<!-- <menu>
    <button id="updateDetails">Mettre à jour les détails</button>
</menu> -->