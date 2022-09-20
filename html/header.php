<header>
    <div class="connect">
      <ul>
      <li id="numpan"><a href="/Panier"><?php if ($_SESSION['panier']) echo "<i title=\"Voir le panier\" class=\"fa-solid fa-cart-shopping\">". array_sum($_SESSION['panier'])."</i>" ?></a></li>
      <?php if (isset($_SESSION["id_cli"])) {
        echo '<li>Bienvenue '.$_SESSION["prenom"].' '.$_SESSION["nom"].'&nbsp</li>';
          if ($_SESSION["level"]==1) {
            echo '<li><a href="/Contact"><i title="Aller à l\'administration du site" class="fa-solid fa-screwdriver-wrench"></i></a></li>';
          } 
        } else { 
          echo '
      <li><a class="button" href="/Connexion">Connexion</a></li>
      <li><a class="button" href="/Inscription">Inscription</a></li>';
      }; ?>
    </ul>
  </div>
  <div class="cont">
  <div class="logo"><a href="/"><img src="/img/logoaca.jpg" alt="logo"></a></div>
  <nav class="navbar">
    <div class="hoht">
      <h1>Asinerie Cap Âne</h1>
      <h2>Balades à dos d'âne & produits cosmétiques au lait d'ânesse</h2>   
    </div>
    <ul class="navlist">
      <li><a href="/Balade-a-dos-d-ane">Balade à dos d'âne</a></li>
      <li><a href="/Location-d-anes-bates">Location d'ânes batés</a></li>
      <li><a href="/Vente-d-ane">Vente d'âne</a></li>
      <li><a href="/Ecopastoralisme">Ecopastoralisme</a></li>
      <li><a href="/Boutique">Boutique</a></li>
    </ul>
    <div class="hamburger fas fa-bars"></div>
  </nav>
  </div>
</header>