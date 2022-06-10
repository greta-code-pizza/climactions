<body>
  <div class="global-container">
    <nav id="side-nav">
      <div class="nav-logo">
        <img src="" alt="">
        <p class="admin">Admin</p>
        <a href="indexAdmin.php?action=accountAdmin&id=<?= $_SESSION['id'] ?>" class="account">
          <i class="fa-solid fa-user"></i>
          <span class="nav-links">Mon compte</span>
        </a>
      </div>
      <div>
        <a href="indexAdmin.php?action=homeAdmin" class="bloc-link">
          <i class="fa-solid fa-house"></i>
          <span class="nav-links">Accueil</span>
        </a>
        <a href="indexAdmin.php?action=emailAdmin" class="bloc-link">
          <i class="fa-solid fa-envelope"></i>
          <span class="nav-links">Email</span>
        </a>
        <a href="indexAdmin.php?action=resourceAdmin" class="bloc-link">
          <i class="fa-solid fa-database"></i>
          <span class="nav-links">Ressources</span>
        </a>
        <a href="indexAdmin.php?action=addressBookAdmin" class="bloc-link">
          <i class="fa-solid fa-address-book"></i>
          <span class="nav-links">Carnet d'adresses</span>
        </a>
        <a href="indexAdmin.php?action=deconnexion" class="bloc-link">
          <i class="fa-solid fa-power-off"></i>
          <span class="nav-links">Se déconnecter</span>
        </a>
        <div id="return-btn">
        <a href="index.php" class="bloc-link">  
          <i class="fa-solid fa-arrow-left"></i>
          <span>Retourner sur le site</span>
        </a>
        </div>
      </div>
    </nav>