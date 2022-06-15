<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Public/admin/css/style.css">
    <title>Connexion</title>
</head>
<body>
    <section id="section-connectAdmin">
    <h1>Connexion Administrateur</h1>
   <form id="form_admin" action="indexAdmin.php?action=connectAdmin" method="post">

       <!-- bloc confirmation || erreur  -->
       <?php if (isset($erreur)): 
                    if ($erreur) : ?>
                <div class="msg-error"><?= $erreur ?></div>
                <?php 
            
            endif;
        endif;
            ?>

        <div>
            <label for="email"> Email:</label>
            <input type="email" name="email" id="email" placeholder="Votre email" required>
        </div>

        <div>
            <label for="password"> Mot de Passe:</label>
            <input type="password" name="password" id="password" placeholder="Votre mot de passe" required>
        </div>
        <button class="btnConnexion" type="submit">Connexion</button>
        <span class="psw"><a href="indexAdmin.php?action=forgot_password">Mot de passe oublié ?</a></span>
    </form>
    </section>
</body>
</html>

