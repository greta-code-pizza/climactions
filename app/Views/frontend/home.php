<?php $title = "Clim' Actions";
$description = "La page d'accueil";
require_once 'layouts/header.php' ?>

<main id="contenu">
    <h1>Votre centre de ressources</h1>
    <section id="encart" class="container">
        <h2>Comment fonctionne le nouveau centre de ressources ?</h2>
        <p>Bienvenue sur notre nouveau centre de ressources. Comme vous pouvez le voir, il est encore en construction. Nous espérons que vous trouverez ici tout ce dont vous avez besoin pour réserver des ressources.</p>
        <p> Nous vous invitons à vous rendre sur la page regroupant pour voir <a href="/index.php?action=pageArticles">les différentes ressources disponibles</a>.</p>
        <p> Après avoir fait vos choix, n'hésitez pas à nous envoyer un message via le formulaire de contact, afin de nous faire part de vos attentes et que l'on puisse valider votre réservation. </p>
    </section>
    <section id="articles">
        <div class="container">
            <h2>Nos nouveautés <img src="./Public/img/feuille-articles.svg" alt="image-feuille"> </h2>
            <!-- affichage des 3 derniers articles (titre et genre) -->
            <?php foreach ($lastArticles as $article) { ?>
            <article id="article">
                <h3><?= $article['name'] ?></h3>
                <!-- <p> <//?= $article['genre']; ?></p> -->
                <a href="#"> <img src="./Public/img/deplacement-une-affaire-de-choix.jpeg"
                        alt="Déplacement une affaire de choix">
                </a>
                <a href="index.php?action=article&id=<?=$article['id']?>&type=<?=$article['type_id']?>" class="bouton-article">En voir plus</a>
            </article>
            <?php } ?>
            <a href="index.php?action=pageArticle" id="bouton-ressources">Découvrir les autres ressources</a>
        </div>
    </section>
</main>

<?php require_once "layouts/footer.php"; ?>