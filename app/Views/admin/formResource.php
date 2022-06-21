<?php 
$title = "Créer un article - CDR Clim'Actions";
$description = "Créer un article";
ob_start(); ?>

<section>

    <h1>Création d'un article</h1>

    <form id="form-create-article" action="" method="post" enctype="multipart/form-data">

        <!-- le type -->
        <div class="item-form type">
            <label for="type">Type</label>
            <select id="select-block" name="type" id="type" >
                <option value="default">Choisir</option>
                <?php foreach($types as $type) {?>
                    <option class="item" value="<?= $type['id'] ?>"><?= $type['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- le titre     -->
        <div class="item-form name">
            <label for="name">Titre</label>
            <input type="text" name="name" id="name" required>
        </div>

        <!-- le thème  -->
        <div class="item-form ">
            <label for="theme">Thème</label>
            <select name="theme" id="theme">
                <?php foreach($themes as $theme) {?>
                    <option class="item" value="<?= $theme['id'] ?>"><?= $theme['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- l'image -->
        <div class="item-form image">
            <label for="image">Image</label>
            <input type="file" name="image" id="image" required>
        </div>

        <!-- le contenu -->
        <div class="item-form content">
            <p class="content-label">Contenu</p>
            <textarea aria-label="content"  name="editor1" id="editor1" cols="30" rows="8">
            </textarea>
        </div>

        <!-- la quantité -->
        <div class="item-form quantite">
            <label for="quantite">Quantité</label>
            <input type="number" value="1" min=0 name="quantity" id="quantite" required>
        </div>

        <!-- la caution -->
        <div class="item-form caution">
            <label for="caution">Caution</label>
            <input type="number" value="0" name="deposit" id="caution" required>
        </div>

        <!-- état -->
        <div class="item-form condition">
            <label for="condition">État</label>
            <select name="condition" id="condition" >
                <?php foreach($conditions as $condition) {?>
                    <option class="item" value="<?= $condition['id'] ?>"><?= $condition['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- ------------------------------------------------- -->

        <!-- staff -->

        <div>
            <div class="item-form  role">
                <label for="role">Role</label>
                <select name="role" id="role" >
                    <?php foreach($roles as $role) {?>
                        <option class="item" value="<?= $role['id'] ?>"><?= $role['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="item-form  name-author">
                <label for="name-author">Contributeur</label>
                <input type="text" name="name-author" id="name-author" required>
            </div>
        </div>


        <!-- format expo -->
        <div class="item-form format-poster">
            <label for="format-poster">Format affiche</label>
            <input class="increase" type="checkbox" name="format-poster" id="format-poster">
        </div>

        <div class="item-form format-sign">
            <label for="format-sign">Format panneau</label>
            <input class="increase" type="checkbox" name="format-sign" id="format-sign">
        </div>

        <div class="item-form format-kakemono">
            <label for="format-kakemono">Format kakemono</label>
            <input class="increase" type="checkbox" name="format-kakemono" id="format-kakemono">
        </div>

        <!-- public -->
        <div class="item-form name-public">
            <label for="name-public">Public</label>
            <select name="name-public" id="name-public">
                <?php foreach($publics as $public) {?>
                    <option class="item" value="<?= $public['id'] ?>"><?= $public['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <button class="btn-create" type="submit">Ajout Ressource</button>
    </form>
</section>

<script src="./Public/admin/js/action.js"></script>
<script src="./Public/admin/js/form-categories.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>