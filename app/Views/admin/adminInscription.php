<?php
$title = "Page de création d'un administrateur";
$description = "Page de création d'un administrateur";
ob_start(); ?>


<section id="container_inscription_admin">
    <div class="createAdmin-container">
    <h1>Création de l'administrateur</h1>
    
    
    <form id="form_admin" action="indexAdmin.php?action=creatAdmin" method="post">

     <!-- bloc confirmation || erreur  -->
     <?php if (isset($erreur)): 
                    if ($erreur) :
                        foreach($erreur as $e):
             ?>
                <div class="msg-error"><?= $e ?></div>
                <?php 
            endforeach;
            endif;
        endif;
            ?>

        <div class="bloc-form">
            <label for="lastname"> Nom:</label>
            <input type="text" name="lastname" id="lastname" placeholder="Votre nom" value="<?php if(isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname'])?>" required>
        </div>

        <div class="bloc-form">
            <label for="firstname"> Prénom:</label>
            <input type="text" name="firstname" id="firstname" placeholder="Votre prénom" value="<?php if(isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname'])?>" required>
        </div>

        <div class="bloc-form">
            <label for="email"> Email:</label>
            <input type="email" name="email" id="email" placeholder="Votre email" value="<?php if(isset($_POST['email'])) echo htmlspecialchars($_POST['email'])?>" required>
        </div>
        <div class="bloc-form">
            <label for="emailconf"> Confirmation Email:</label>
            <input type="email" name="emailconf" id="emailconf" placeholder="Votre email" required>
        </div>
        <div class="bloc-form">
            <label for="password"> Mot de passe</label>
            <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
        </div>
        <div class="bloc-form">
            <label for="passwordconf"> Vérification Mot de passe</label>
            <input type="password" name="passwordconf" id="passwordconf" placeholder="Votre mot de passe" required>
        </div>
       
        <button class="btn-createAdmin" type="submit">Créer</button>
    </form>
    </div>
</section>


<?php $content = ob_get_clean();
require "app/Views/admin/layouts/dashboard.php";
