<?php
$title = "Page de contact";
$description = "Page de contact";
ob_start();
?>

    <section class="container-contact bloc-contact-user">

        <div class="main-bloc-form">
            <form action="index.php?action=contactPost" method="POST">
                <h1>Contactez-Nous</h1>

                <?php if (isset($erreur)):
                if($erreur): 
                    foreach($erreur as $e):
                    ?>
                <p class="msg-error"><?= $e ?></p>
                <?php
                endforeach;

                endif;
            endif;
            ?>
                <div class="bloc-form">
                    <label for="lastname">Nom : </label>
                    <input type="text" id="lastname" name="lastname" placeholder="Votre Nom" value="<?php if (isset($_POST['lastname'])) echo htmlspecialchars($_POST['lastname'])
                     ?>" required />
                </div>
                <div class="bloc-form">
                    <label for="firstname">Prénom :</label>
                    <input type="text" id="firstname" name="firstname" placeholder="Votre Prénom" value="<?php if (isset($_POST['firstname'])) echo htmlspecialchars($_POST['firstname'])
                     ?>" required />
                </div>
                <div class="bloc-form">
                    <label for="email">E-mail : *</label>
                    <input type="email" id="email" name="email" placeholder="Votre e-mail" value="<?php if (isset($_POST['email'])) echo htmlspecialchars($_POST['email'])
                     ?>" required />
                </div>
                <div class="bloc-form">
                    <label for="confirmEmail">Confirmation E-mail : *</label>
                    <input type="email" id="confirmEmail" name="confirmEmail" placeholder="Votre e-mail" required />
                </div>
                <div class="bloc-form">
                    <label for="phone">Téléphone : *</label>
                    <input type="phone" id="phone" name="phone" placeholder="Votre Numéro de Téléphone" required />
                </div>
                <div class="bloc-form">
                    <label for="object">Objet : *</label>
                    <input type="object" id="object" name="object" placeholder="objet de votre demande" required />
                </div>
                <div class="bloc-form">
                    <label for="message">Message : *</label>
                    <textarea id="message" name="message" placeholder="Votre message" required></textarea>
                </div>
                <div>
                    <input type="checkbox" id="autorisation" required />
                    <label for="autorisation">&nbsp; En soumettant ce formulaire, j'autorise ce site à conserver mes
                        données personnelles. Aucune exploitation commerciale ne sera faite des données
                        conservées.</label>
                </div>

                <button class="send-contact" type="submit">Envoyer</button>
                <p>* Champs obligatoires</p>
            </form>
        </div>

    </section>
<script src="./Public/scripts/contact.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require "layouts/template.php";