<?php 
$title = "Vos Ressources - CDR Clim'Actions";
$description = "Vos Ressources";
ob_start(); ?>

<h1>Les Ressources</h1>

<section id="bar-search" class="container">

    <!-- barre de recherche -->
    
    <?php 
    include_once "layouts/search.php";
    if (isset($search) && !empty($search) && isset($_GET['search'])) : ?>
    
    <section>

    <h2 class="title-search">Votre Recherche: "<em><?= $query ?></em>"</h2>
        
    <span class="btn-create"><a href="indexAdmin.php?action=resourceAdmin">Revenir</a></span>

        <div class="table">
            <h3 class="table-title">Titre</h3>
            <h3 class="table-title">Contenu</h3>
            <h3 class="table-title">Publié le</h3>
            <h3 class="table-title">Action</h3>
        </div>

        <div class="bg">
            <?php foreach ($search as $resource) {?>
            <div class="table-results">
                <ul class="table-item">
                    <li class="article-title"><?= $resource["name"] ?></li>
                    <li class="article-content"><?= $resource["content"] ?></li>
                    <li class="article-created-at"><?= $resource["date"] ?></li>
                    <li class="flex">
                        <span class="btn"><a href="#"><i class="fa-solid fa-pen"></i></a></span>
                        <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteArticle&id=<?=$resource['id']?>"><i class="fa-solid fa-trash-can"></i></a></span>
                    </li>
                </ul>
            </div>
            <?php } ?>
        </div>
    </section>

    <?php else : ?>

    <h2 class="main-title">Création et mise à jour d'une ressource</h2>

    <span class="btn-create"><a href="indexAdmin.php?action=formCreateResource">Créer</a></span>

    <div class="table">
        <h3 class="table-title">Titre</h3>
        <h3 class="table-title">Contenu</h3>
        <h3 class="table-title">Publié le</h3>
        <h3 class="table-title">Action</h3>
    </div>

    <div class="bg">
        <?php foreach ($resources as $resource) { ?>
        <div class="table-results">

            <ul class="table-item">
                <li class="article-title"><?= substr($resource["name"], 0, 30) . " ..."; ?></li>
                <li class="article-content"><?= htmlspecialchars_decode(substr($resource["content"], 0, 100)) . " ..." ?></li>
                <li class="article-created-at"><?= $resource["date"] ?></li>
                <li class="flex">
                    <span class="btn"><a href="indexAdmin.php?action=formUpdateArticle&id=<?=$resource["id"]?>&type_id=<?=$resource['type_id']?>"><i class="fa-solid fa-pen"></i></a></span>
                    <span class="btn"><a class="delete" href="indexAdmin.php?action=deleteArticle&id=<?=$resource["id"]?>"><i class="fa-solid fa-trash-can"></i></a></span>
                </li>
            </ul>
        </div>
        <?php }; ?>
    </div>

    
    <!-- pagination -->
    
</section>
    <nav id="nav-pagination">
        <ul class="pagination">
            <!-- Lien vers la page précédente (désactivé si on se trouve sur la 1ère page) -->
            <li class="page-item <?= ($currentPage == 1) ? "hidden" : "" ?>">
                <a title="précédent"
                    href="indexAdmin.php?action=resourceAdmin&page=<?= htmlspecialchars($currentPage - 1) ?>"
                    class="page-link">Précédente</a>
            </li>
            <?php for($page = 1; $page <= $pages; $page++): ?>
            <!-- Lien vers chacune des pages (activé si on se trouve sur la page correspondante) -->
            <li class="page-item <?= ($currentPage == $page) ? "active" : "" ?>">
                <a title="page" href="indexAdmin.php?action=resourceAdmin&page=<?= $page ?>"
                    class="page-link"><?= $page ?></a>
            </li>
            <?php endfor ?>
            <!-- Lien vers la page suivante (désactivé si on se trouve sur la dernière page) -->
            <li class="page-item <?= ($currentPage == $pages) ? "hidden" : "" ?>">
                <a title="suivant"
                href="indexAdmin.php?action=resourceAdmin&page=<?= htmlspecialchars($currentPage + 1) ?>"
                class="page-link">Suivante</a>
            </li>
        </ul>
    </nav>
    <?php endif ?>
    
<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>