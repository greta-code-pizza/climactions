<?php
$title = "Vos ressources - CDR Clim'Actions";
$description = "Les ressources";
require 'app/Views/frontend/layouts/header.php';
?>


<section id="container_formulaire_article">

    <h1>Création des articles</h1>

    <form id="form_admin" action="indexAdmin.php?action=addArticle" method="post">

        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" placeholder="titre" required>
        </div>     

        <div>
            <label for="content">Contenu</label>
            <textarea required="required" name="content" id="content" cols="30" rows="8"></textarea>
        </div>

        <button type="submit">Créer un article</button>
    </form>
</section>
<section>

<h2>Mes articles</h2>

<?php foreach($allArticles as $article) : ?>
    <h3><?= $article['title'] ?></h3>
    <p><?= $article['content'] ?></p>
    <a title="Modifier" href="indexAdmin.php?action=viewUpdateArticle&id=<?= $article['id'] ?>">Modifier</a>
    <a title="Supprimer" href="indexAdmin.php?action=deleteArticle&id=<?= $article['id'] ?>">Supprimer</a> 
<?php endforeach ?>


</section>


<?php
require 'app/Views/frontend/layouts/footer.php';
?>