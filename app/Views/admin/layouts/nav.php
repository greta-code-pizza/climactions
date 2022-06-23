<body>
  <div class="global-container">
    <nav id="side-nav">
      <div class="nav-logo">
        <p class="admin"><?= $_SESSION['firstname'] ?></p>
        <a href="indexAdmin.php?action=accountAdmin&id=<?= $_SESSION['id'] ?>" class="account" rel="nofollow">
          <i class="fa-solid fa-user"></i>
          <span class="nav-links">Mon compte</span>
        </a>
      </div>
      <div class="nav">
        <a href="indexAdmin.php?action=homeAdmin" class="bloc-link" rel="nofollow">
          <i class="fa-solid fa-house"></i>
          <span class="nav-links">Accueil</span>
        </a>
        <a href="indexAdmin.php?action=emailAdmin" class="bloc-link" rel="nofollow">
          <i class="fa-solid fa-envelope"></i>
          <span class="nav-links">Email</span>
        </a>
        <a href="indexAdmin.php?action=resourceAdmin" class="bloc-link" rel="nofollow">
          <i class="fa-solid fa-database"></i>
          <span class="nav-links">Ressources</span>
        </a>
        <a href="indexAdmin.php?action=addressBookAdmin" class="bloc-link" rel="nofollow">
          <i class="fa-solid fa-address-book"></i>
          <span class="nav-links">Carnet d'adresses</span>
        </a>
        <a href="Public/admin/pdf/guide-admin.pdf" target="_blank" class="bloc-link" rel="nofollow">
          <i class="fa-solid fa-book"></i>
          <span class="nav-links">Guide d'utilisation</span>
        </a>
        <a href="indexAdmin.php?action=deconnexion" class="bloc-link" rel="nofollow">
          <i class="fa-solid fa-power-off"></i>
          <span class="nav-links">Se déconnecter</span>
        </a>
        <div id="return-btn">
        <a href="index.php" class="bloc-link" rel="nofollow">  
          <i class="fa-solid fa-arrow-left"></i>
          <span>Retourner sur le site</span>
        </a>
        </div>
      </div>
    </nav>