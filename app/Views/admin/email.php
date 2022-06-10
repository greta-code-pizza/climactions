<?php ob_start(); ?>

<h1>Les emails</h1>
<?php if (isset($erreur)): 
    if ($erreur) :
        foreach($erreur as $e):?>
            <div class="msg-error"><?= $e ?></div>
        <?php endforeach;
    endif;
endif;?>
<section id="bar-search" class="container">
    <?php 
    include_once "layouts/searchEmail.php";
    if (isset($query) && !empty($query) && isset($_GET['search'])) : ?>

    <section>

        <span class="btn-create"><a href="indexAdmin.php?action=emailAdmin">Revenir</a></span>

        <div class="table">
            <h3 class="table-title">Prénom et Nom</h3>
            <h3 class="table-title">Contenu de l'email</h3>
            <h3 class="table-title">Publié le</h3>
            <h3 class="table-title">Action</h3>
        </div>

        <div class="bg">
            <?php foreach ($search as $email) { ?>
            <div class="table-results">
                <?php if($email['read'] == 0 ):?>
                    <ul class="table-item gras">
                <?php else: ?>
                    <ul class="table-item lu">
                <?php endif; ?>
                    <li ><?= $email["firstname"] . " " . $email["lastname"] ?></li>
                    <li><?= $email["message"]?></li>
                    <li><?= $email["date"]?></li>
                    <li class="flex">
                        <span class="btn"><a href="indexAdmin.php?action=readEmail&id=<?= $email['id']?>&read=<?=$email['read']?>"
                                title="Lire"><i class="fa-solid fa-eye"></i></a></span>
                        <span class="btn"><a class="delete"
                                href="indexAdmin.php?action=deleteEmail&id=<?= $email['id'] ?>" title="Supprimer"><i
                                    class="fa-solid fa-trash-can"></i></a></span>
                        <span class="btn"><a href="indexAdmin.php?action=addAdressBook&id=<?= $email['id'] ?>" title="Ajouter au carnet d'adresse"><i
                                    class="fa-solid fa-address-book"></i></a></span>
                    </li>
                </ul>
            </div>
            <?php }; ?>
        </div>
    </section>

    <?php else : ?>

    <div class="table">
        <h3 class="table-title">Prénom et Nom</h3>
        <h3 class="table-title">Contenu de l'email</h3>
        <h3 class="table-title">Publié le</h3>
        <h3 class="table-title">Action</h3>
    </div>
    <div class="bg">
        <?php foreach ($emails as $email) { ?>
        <div class="table-results">
            <?php if($email['read'] == 0 ):?>
                    <ul class="table-item gras">
                <?php else: ?>
                    <ul class="table-item lu">
                <?php endif; ?>
                <li><?= $email["firstname"] . " " . $email["lastname"] ?></li>
                <li><?= $email["message"]?></li>
                <li><?= $email["date"]?></li>
                <li class="flex">
                    <span class="btn"><a href="indexAdmin.php?action=readEmail&id=<?= $email['id']?>&read=<?=$email['read']?>" title="Lire"><i
                                class="fa-solid fa-eye"></i></a></span>
                    <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteEmail&id=<?= $email['id'] ?>"
                            title="Supprimer"><i class="fa-solid fa-trash-can"></i></a></span>
                    <span class="btn">
                        <a href="indexAdmin.php?action=addAdressBook&id=<?= $email['id'] ?>" title="Ajouter au carnet d'adresse"><i
                                class="fa-solid fa-address-book"></i></a></span>
                </li>
            </ul>
        </div>
        <?php }; ?>
    </div>

    <?php endif ?>

    <!-- pagination -->

    <nav id="nav-pagination">
        <ul class="pagination">
            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($currentPage == 1) ? "hidden" : "" ?>">
                <a title="précédent"
                    href="indexAdmin.php?action=emailAdmin&page=<?= htmlspecialchars($currentPage - 1) ?>"
                    class="page-link">Précédente</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a title="page" href="indexAdmin.php?action=emailAdmin&page=<?= $page ?>"
                    class="page-link"><?= $page ?></a>
            </li>
            <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "hidden" : "" ?>">
                <a title="suivant"
                    href="indexAdmin.php?action=emailAdmin&page=<?= htmlspecialchars($currentPage + 1) ?>"
                    class="page-link">Suivante</a>
            </li>
        </ul>
    </nav>

</section>
<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>