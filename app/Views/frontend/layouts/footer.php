<footer id="pied">
    <div class="container">
        <div id="menu-bas" class="item-footer">
            <h2>Menu</h2>
            <ul id="menu-pied">
                <li><a href="index.php">Accueil</a></li>
                <li><a href="index.php?action=pageArticle">Ressources</a></li>
                <li><a href="index.php?action=contact">Contact</a></li>
                <?php if(!isset($_SESSION['id'])) :?>
                <li><a href="indexAdmin.php">Connexion</a></li>
                <?php else: ?>
                <li><a href="indexAdmin.php?action=homeAdmin">Dashboard</a></li>
                <li><a href="indexAdmin.php?action=deconnexion">Déconnexion</a></li>
                <?php endif; ?>
            </ul>
        </div>

        <div id="reseaux-sociaux" class="item-footer">
            <h2>Nos réseaux sociaux</h2>
            <div id="reseaux">
                <a href="https://fr-fr.facebook.com/climactions/"><img src="./Public/img/icon-facebook.svg" alt="facebook" title="Facebook"></a>
                <a href="https://twitter.com/climactions"><img src="./Public/img/icon-twitter.svg" alt="twitter" title="Twitter"></a>
                <a href="https://instagram.com/climactions.bretagnesud/?hl=fr"><img src="./Public/img/icon-instagram.svg" alt="instagram" title="Instagram"></a>
                <a href="https://fr.linkedin.com/company/clim%27actions-bretagne-sud"><img src="./Public/img/icon-linkedin.svg" alt="linkedin" title="Linkedin"></a>
            </div>
        </div>

        <div id="adresse" class="item-footer">
            <h2>Adresse</h2>
            <address>
                39bis rue Albert 1er <br>
                56000 VANNES
            </address>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2687.81549805064!2d-2.766611585132512!3d47.64915207918746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48101c20f91c6397%3A0xc8e61dc824bf3c15!2s39%20Rue%20Albert%201er%2C%2056000%20Vannes!5e0!3m2!1sfr!2sfr!4v1651673137982!5m2!1sfr!2sfr"
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <div id="legals-footer">
        <ul>
            <li><a href="index.php?action=cgu">CGU</a></li>
            <li><a href="index.php?action=legalNotice">Mentions légales</a></li>
            <li><a href="index.php?action=cookies">Cookies</a></li>
        </ul>
        <p>Tous droits réservés - 2022 - <a href="https://climactions-bretagnesud.bzh/">Clim'actions Bretagne Sud</a></p>
    </div>

</footer>


<script src="./Public/scripts/main.js"></script>
<script src="./Public/scripts/active-front.js"></script>


</body>

</html>