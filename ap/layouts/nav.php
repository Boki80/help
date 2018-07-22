<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="index.php">HELP Admin Panel</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Aktivnosti
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="aktivnosti.php">Sve aktivnosti</a>
          <a class="dropdown-item" href="zavrsene_aktivnosti.php">Završene aktivnosti</a>
          <a class="dropdown-item" href="nezavrsene_aktivnosti.php">Nezavršene aktivnosti</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Korisnici
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="korisnici.php">Svi korisnici</a>
          <a class="dropdown-item" href="aktivni.php">Aktivni korisnici</a>
          <a class="dropdown-item" href="deaktivirani.php">Deaktivirani korisnici</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Korisnici paketa
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="korisnici-paketa.php">Svi korisnici</a>
          <a class="dropdown-item" href="paket-l.php">L</a>
          <a class="dropdown-item" href="paket-x.php">X</a>
          <a class="dropdown-item" href="paket-xl.php">XL</a>
          <a class="dropdown-item" href="paket-xxl.php">XXL</a>
        </div>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Dodaj
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="dodaj_korisnika.php">Korisnika</a>
          <a class="dropdown-item" href="dodaj_aktivnost.php">Aktivnost</a>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="aktivacija_paketa.php">Aktivacija paketa</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Članarine
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="clanarine.php">Sve</a>
          <a class="dropdown-item" href="istekle_clanarine.php">Istekle</a>
          <a class="dropdown-item" href="clanarine_pri_isteku.php">Pri isteku</a>
          <a class="dropdown-item" href="neistekle_clanarine.php">Neistekle</a>
        </div>
      </li>
      <li class="nav-item"><a class="nav-link" href="narudzbe.php">Narudžbe</a></li>
      <li class="nav-item"><a class="nav-link" href="registracija.php">Novi korisnici</a></li>
      <li class="nav-item"><a class="nav-link" href="../index.php">Naslovna</a></li>
        <?php if(isset($_SESSION['login_user'])) { ?>
          <li class="nav-item"><a class="nav-link" href="profil.php?id=<?php echo $_SESSION['login_id']; ?>">Profil</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php">Odjavi se <?php echo $_SESSION['login_user']; ?></a></li>
        <?php } else { ?>
        <li class="nav-item"><a class="nav-link" href="login.php">Prijava</a></li>
        <?php } ?>
    </ul>
  </div>
</nav>