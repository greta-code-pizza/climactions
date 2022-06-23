<?php $title = "Clim' Actions";
$description = "La page d'accueil";
require_once 'layouts/header.php';?>

<main id="contenu">
    <h1>Votre centre de ressources</h1>
    <section id="encart" class="container">
        <h2>Comment fonctionne le nouveau centre de ressources ?</h2>
        <p>Bienvenue sur notre nouveau centre de ressources, nous espérons que vous trouverez ici tout ce dont vous avez besoin pour réserver nos ressources.</p>
        <p> Nous vous invitons à vous rendre sur la page regroupant pour voir <a href="pageArticle">les différentes ressources disponibles</a>.</p>
        <p> Après avoir fait vos choix, n'hésitez pas à nous envoyer un message via le formulaire de contact, pour nous faire part de vos attentes afin que l'on puisse valider votre réservation. </p>
    </section>
    <section id="articles">
        <div class="container">
            <h2>Nos nouveautés <img src="./Public/img/feuille-articles.svg" alt="feuille"> </h2>
            <!-- affichage des 3 derniers articles (titre et genre) -->
            <?php foreach ($lastArticles as $article) { ?>
            <article class="article">
                <h3><?= $article['name'] ?></h3>
                <a href="#"> <img src="<?= $article['image'] ?>"
                        alt="<?= $article['name'] ?>">
                </a>
                <a href="article&id=<?=$article['id']?>&type=<?=$article['type_id']?>" class="bouton-article">En voir plus</a>
            </article>
            <?php } ?>
            <a href="pageArticle" id="bouton-ressources">Découvrir les autres ressources</a>
        </div>
    </section>
    <section id="partenaires" class="container">
        <h2>Nos partenaires <img src="./Public/img/feuille-agenda.svg" alt="feuille"> </h2>
        <div class="partenaires-img">
            <img src="./Public/img/partenaires/logo-ademe.svg" alt="ademe">
            <img src="./Public/img/partenaires/logo-gbs.jpg" alt="greta bretagne sud">
        </div>
    </section>
</main>

<?php require_once "layouts/footer.php"; ?>