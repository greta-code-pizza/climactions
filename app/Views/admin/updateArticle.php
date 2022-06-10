<?php
$title = "Mettre à jour une ressource - CDR Clim'Actions";
$description = "Mettre à jour une ressource";
require 'app/Views/frontend/layouts/header.php';
?>

<section id="container_formulaire_article">

    <h1>Modifier l'article</h1>

    <form id="form_admin" action="indexAdmin.php?action=updateArticle&id=<?= $oneArticle['id'] ?>" method="post">

        <div>
            <label for="title">Titre :</label>
            <input type="text" name="title" id="title" placeholder="titre" required value="<?= $oneArticle['title'] ?>">
        </div>     

        <div>
            <label for="content">Contenu</label>
            <textarea name="content" id="content" cols="30" rows="8" required ><?= $oneArticle['content'] ?></textarea>
        </div>

        <button type="submit">Enregistrer les modifications</button>
    </form>
</section>

<?php
require 'app/Views/frontend/layouts/footer.php';
?>