<?php 
$title = "Clim' Actions";
$description = "La page affichage d'un article";

ob_start(); ?>

<section class="container container-article">

    <article>

        <h1 class="title"><?= $article['name']; ?></h1>

        <div class="article">

            <figure class="img-size">
                <img src="<?= $article['image'] ?>" alt="image de <?= $article['name'] ?>">
            </figure>

            <!-- faire des conditions -->
            <section class="info">
                <h2 class="title">Informations : </h2>
                
                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 4)){
                    ?>
                <!-- pour les flyers -->
                <p class="type">Type : <?= $flyer['type'] ?></p>
                <p class="theme">Thème : <?= $flyer['theme'] ?></p>
                <?php }; ?>

                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 2)){
                    // var_dump($article['type_id'] === 2);die;
                    ?>
                <!-- pour les livres -->
                <p class="type">Type : <?= $otherResource['type'] ?></p>
                <p class="theme">Thème : <?= $otherResource['theme'] ?></p>

                <p class="author">Auteur : </p>
                <p class="editor">Éditeur : </p>
                <p class="public">Public : <?= $otherResource['public'] ?></p>
                <?php }; ?>

                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 3)){
                    // var_dump($article['type_id'] === 3);die;
                    ?>
                <!-- pour les films -->
                <p class="type">Type : <?= $otherResource['type'] ?></p>
                <?php
                // var_dump($otherResource['type']);die;
                ?>
                <p class="theme">Thème : <?= $otherResource['theme'] ?></p>
                <p class="director">Réalisateur :</p>
                <p class="producer">Producteur :</p>
                <p class="public">Public : <?= $otherResource['public'] ?></p>
                <p class="condition">Condition : <?= $otherResource['condition'] ?></p>
                <?php }; ?>

                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 1)){
                    // var_dump($article['type_id']);die;
                    ?>
                <!-- pour les jeux -->
                <p class="type">Type : <?= $game['type'] ?></p>
                <p class="theme">Thème : <?= $game['theme'] ?></p>
                <p class="creator">Créateur : <?= $game['firstname'] ?> <?= $game['lastname'] ?></p>
                <p class="format">Format : <?= $game['game_format'] ?></p>
                <p class="public">Public : <?= $game['public'] ?></p>
                <?php }; ?>

                <!-- quantity -->
                <p class="format">Quantité : <?= $article['quantity'] ?></p>
                <!-- la caution -->
                <p class="format">Caution : <?= $article['deposit']." €" ?></p>

            </section>


            <div class="content">
                <div class="line"></div>
                <p><?= $article['content'] ?></p>
                <p class="created-at"><strong>Créé le : </strong><?= $article['created_at'] ?></p>

            </div>

        </div>

    </article>
    <a href="index.php?action=pageArticle" class="btn">Revenir sur tous les articles</a>


</section>

<?php $content = ob_get_clean(); ?>
<?php require "layouts/template.php";