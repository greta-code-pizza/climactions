<?php 
$title = "Créer un article - CDR Clim'Actions";
$description = "Créer un article";
ob_start(); ?>

<section>
    <h1>Création d'un article</h1>
    <?php if($typeId == 4){?>


        <form id="form-create-article" action="indexAdmin.php?action=updateResourceExpo&id=<?= $resource['id'] ?>" method="post" enctype="multipart/form-data">
        <!-- le titre     -->
        <div class="item-form name">
            <label for="name">Titre</label>
            <input type="text" name="name" id="name" value="<?=$resource['name'] ?>" required>
        </div>

        <!-- le thème  -->
        <div class="item-form ">
            <label for="theme">Thème</label>
            <select name="theme" id="theme">
            <option class="item" value="<?= $resource['theme_id'] ?>" selected><?= $resource['theme'] ?></option>
                <?php foreach($themes as $theme) {?>
                    <option class="item" value="<?= $theme['id'] ?>"><?= $theme['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- l'image -->
        <div class="item-form image">
            <label for="image">Image</label>
            <input type="file" name="image" id="image">
        </div>

        <!-- le contenu -->
        <div class="item-form content">
            <p class="content-label">Contenu</p>
            <textarea aria-label="content"  name="editor1" id="editor1" cols="30" rows="8"><?= $resource['content'] ?>
            </textarea>
        </div>

        <!-- la quantité -->
        <div class="item-form quantite">
            <label for="quantite">Quantité</label>
            <input type="number" value="<?= $resource['quantity']?>" min=0 name="quantity" id="quantite" required>
        </div>

        <!-- la caution -->
        <div class="item-form caution">
            <label for="caution">Caution</label>
            <input type="number" value="<?= $resource['deposit'] ?>" name="deposit" id="caution" required>
        </div>

        <!-- état -->
        <div class="item-form condition">
            <label for="condition">État</label>
            <select name="condition" id="condition" >
                <option class="item" value="<?= $resource['condition_id'] ?>" selected><?= $resource['condition'] ?></option>
                <?php foreach($conditions as $condition) {?>
                    <option class="item" value="<?= $condition['id'] ?>"><?= $condition['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <!-- ------------------------------------------------- -->

        <!-- staff -->

        <div class="item-form  name-author">
            <label for="name-editor">Contributeur</label>
            <select name="name-author" id="name-author" >
            <option class="item" value="<?= $resource['personality_id'] ?>" selected><?= $resource['role'] ?> - <?= $resource['staff'] ?></option>
                <?php foreach($personalities as $personality) {?>
                    <option class="item" value="<?= $personality['id'] ?>"><?= $personality['role'] ?> - <?= $personality['name'] ?></option>
                <?php } ?>
            </select>
        </div>
        
        <!-- format expo -->
        <div class="item-form format-poster">
            <label for="format-poster">Format affiche</label>
            <?php if($resource['poster_bool'] == 1){ ?>
                <input class="increase" type="checkbox" name="format-poster" id="format-poster" checked>
            <?php }else{?>
                <input class="increase" type="checkbox" name="format-poster" id="format-poster">
            <?php }?>
        </div>

        <div class="item-form format-sign">
            <label for="format-sign">Format panneau</label>
            <?php if($resource['sign_bool'] == 1){ ?>
                <input class="increase" type="checkbox" name="format-sign" id="format-sign" checked>
            <?php }else{?>
                <input class="increase" type="checkbox" name="format-sign" id="format-sign">
            <?php }?>
            
        </div>

        <div class="item-form format-kakemono">
            <label for="format-kakemono">Format kakemono</label>
            <?php if($resource['kakemono_bool'] == 1){ ?>
                <input class="increase" type="checkbox" name="format-kakemono" id="format-kakemono" checked>
            <?php }else{?>
                <input class="increase" type="checkbox" name="format-kakemono" id="format-kakemono">
            <?php }?>
        </div>

        <!-- public -->
        <div class="item-form name-public">
            <label for="name-public">Public</label>
            <select name="name-public" id="name-public">
                <option class="item" value="<?= $resource['public_id'] ?>" selected><?= $resource['public'] ?></option>
                <?php foreach($publics as $public) {?>
                    <option class="item" value="<?= $public['id'] ?>"><?= $public['name'] ?></option>
                <?php } ?>
            </select>
        </div>


    <?php }else{?>


        <form id="form-create-article" action="indexAdmin.php?action=updateOtherResources&id=<?= $resource[0]['id'] ?>" method="post" enctype="multipart/form-data">
            <!-- le titre   -->
            <div class="item-form name">
                <label for="name">Titre</label>
                <input type="text" name="name" id="name" value="<?=$resource[0]['name'] ?>" required>
            </div>

            <!-- le thème  -->
            <div class="item-form ">
                <label for="theme">Thème</label>
                <select name="theme" id="theme">
                <option class="item" value="<?= $resource[0]['theme_id'] ?>" selected><?= $resource[0]['theme'] ?></option>
                    <?php foreach($themes as $theme) {?>
                        <option class="item" value="<?= $theme['id'] ?>"><?= $theme['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- l'image -->
            <div class="item-form image">
                <label for="image">Image</label>
                <input type="file" name="image" id="image">
            </div>

            <!-- le contenu -->
            <div class="item-form content">
                <p class="content-label">Contenu</p>
                <textarea aria-label="content"  name="editor1" id="editor1" cols="30" rows="8"><?= $resource[0]['content'] ?>
                </textarea>
            </div>

            <!-- la quantité -->
            <div class="item-form quantite">
                <label for="quantite">Quantité</label>
                <input type="number" value="<?= $resource[0]['quantity']?>" min=0 name="quantity" id="quantite" required>
            </div>

            <!-- la caution -->
            <div class="item-form caution">
                <label for="caution">Caution</label>
                <input type="number" value="<?= $resource[0]['deposit'] ?>" name="deposit" id="caution" required>
            </div>

            <!-- état -->
            <div class="item-form condition">
                <label for="condition">État</label>
                <select name="condition" id="condition" >
                    <option class="item" value="<?= $resource[0]['condition_id'] ?>" selected><?= $resource[0]['condition'] ?></option>
                    <?php foreach($conditions as $condition) {?>
                        <option class="item" value="<?= $condition['id'] ?>"><?= $condition['name'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <!-- ------------------------------------------------- -->

            <!-- staff -->

            <div class="item-form  name-author">
                <label for="name-editor">Contributeur</label>
                <select name="name-author" id="name-author" >
                    <option class="item" value="<?= $resource[1][0]['id'] ?>" selected><?= $resource[1][0]['role'] ?> - <?= $resource[1][0]['staff'] ?></option>
                    <?php foreach($personalities as $personality) {?>
                        <option class="item" value="<?= $personality['id'] ?>"><?= $personality['role'] ?> - <?= $personality['name'] ?></option>
                    <?php } ?>
                </select>
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
    <?php } ?>

    <button class="btn-create" type="submit">Ajout Ressource</button>
    </form>
</section>

<script src="./Public/admin/js/action.js"></script>

<?php $content = ob_get_clean(); ?>
<?php require 'layouts/dashboard.php'; ?>