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
                if(isset($article['type_id']) && ($article['type_id'] === 1)):
                    
                    ?>
                <!-- pour les jeux -->
                <p class="type">Type : <?= $game[0]['type'] ?></p>
                <p class="theme">Thème : <?= $game[0]['theme'] ?></p>
                <p class="creator">Créateur : <?= $game[1][0]['staff'] ?></p>
                <p class="format">Format : <?= $game[0]['game_format'] ?></p>
                <p class="public">Public : <?= $game[0]['public'] ?></p>
                <?php endif; ?>
                
                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 4)){
                    ?>
                <!-- pour les flyers -->
                <p class="type">Type : <?= $flyer['type'] ?></p>
                <p class="theme">Thème : <?= $flyer['theme'] ?></p>
                <p class="format"><?php if($flyer['poster_bool'] == 1){
                    echo "Format : Affiche";
                }
                elseif($flyer['sign_bool'] == 1){
                    echo "Format : Panneau";
                }
                elseif($flyer['kakemono_bool'] == 1){
                    echo "Format : Kakemono";
                }
                elseif($flyer['poster_bool'] == 1 && $flyer['sign_bool'] == 1){
                    echo "Format : Affiche + Panneau";
                }
                else{
                    echo "Format : Non précisé";
                }
                
                
                ?></p>
                <?php }; ?>

                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 2)){
                    
                    ?>
                <!-- pour les livres -->
                <p class="type">Type : <?= $otherResource[0]['type'] ?></p>
                <p class="theme">Thème : <?= $otherResource[0]['theme'] ?></p>

                <p class="author">Auteur : <?= $otherResource[1][0]['staff'] ?></p>
                <p class="editor">Éditeur : </p>
                <p class="public">Public : <?= $otherResource[0]['public'] ?></p>
                <?php }; ?>

                <?php
                if(isset($article['type_id']) && ($article['type_id'] === 3 || 5 || 6)){
                    
                    ?>
                <!-- pour les films -->
                <p class="type">Type : <?= $otherResource[0]['type'] ?></p>
                <?php
                
                ?>
                <p class="theme">Thème : <?= $otherResource[0]['theme'] ?></p>
                <?php if($article['type_id'] === 3): ?>

                    <p class="director">Réalisateur : <?= $otherResource[1][0]['staff'] ?></p>
                <?php elseif($article['type_id'] === 5 || 6): ?>
                    <p class="director">Créateur : <?= $otherResource[1][0]['staff'] ?></p>
                    <?php endif; ?>
                <p class="public">Public : <?= $otherResource[0]['public'] ?></p>
                <p class="condition">Condition : <?= $otherResource[0]['condition'] ?></p>
                <?php }; ?>
                

                <!-- quantity -->
                <p class="format">Quantité : <?= $article['quantity'] ?></p>
                <!-- la caution -->
                <?php if($article['deposit'] == 0): ?>
                    <p class="caution">Caution : Pas de caution</p>
                <?php
                else : ?>

                   <p class="caution">Caution : <?= $article['deposit']." €"  ?></p>
              <?php  endif; ?>
                
            </section>


            <div class="content">
                <div class="line"></div>
                <p><?= htmlspecialchars_decode($article['content']) ?></p>
                <p class="created-at"><strong>Créé le : </strong><?= $article['created_at'] ?></p>

            </div>

        </div>

    </article>
    <a href="index.php?action=pageArticle" class="btn">Revenir sur tous les articles</a>


</section>

<?php $content = ob_get_clean(); ?>
<?php require "layouts/template.php";