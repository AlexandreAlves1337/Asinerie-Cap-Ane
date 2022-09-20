<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class Accueil {

    private string $titre='Accueil';

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
      $this->liste = $liste;
   }

    public function html()
    {

        echo '
        <div class="two-column">
            <section class="accueil">
                <div class="texte">
                    <p>Situé à Générac (au sud de Nîmes dans le département du Gard), nous sommes spécialisé dans l\'élevage d’ânes des Pyrénées.</p>
                    <p>Nous vous proposons des balades à dos d\'âne pour les enfants. Vos enfants monte des ânes équipés d\'une selle et vous les accompagnez à pied sur des chemins plus ou moins long et tous balisé pour un moment de détente et de joie en famille.</p>
                    <p>Nous récoltons également le lait de nos ânesses pour en faire des produits cosmétiques bio de qualité. Notre gamme est disponible à la vente sur notre boutique en ligne mais aussi dans nos locaux et sur les marchés de Générac, Uzès et Calvisson.</p>
                    <p>Nous mettons également nos ânes à votre disposition si vous avez besoin de débroussailler votre terrain de manière naturelle et écologique, ce que l\'on appelle l\'écopastoralisme, mais également si vous avez des projets de très grande randonnée sur plusieurs jours avec nos ânes bâtés.</p>
                </div>
                <div class= "carouselContainer">
                    <div class="carousel">';
                        foreach($this->liste as $photo) {
                        echo '
                        <div class="pic">
                            <img src="img/bibli/Photo_'.$photo->getPhoto().'">
                        </div>';
                        };
                    echo '
                    </div>
                </div>
            </section>
            <aside>
                <h3>Actualités</h3>
                <div class="Facebook">
                    <div class="fb-page" data-href="https://www.facebook.com/profile.php?id=100054211854617" data-tabs="timeline" data-width="" data-height="" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true"><blockquote cite="https://www.facebook.com/profile.php?id=100054211854617" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/profile.php?id=100054211854617">Asinerie Cap Âne</a></blockquote></div>
                </div>
                <div class="rs">
                    <h3>Suivez-nous</h3>
                    <ul>
                        <li><a href="https://www.instagram.com/asinerie_cap_ane/"><img src="/img/instagram.png" alt="instagram"></a></li>
                        <li><a href="https://www.facebook.com/profile.php?id=100054211854617"><img src="/img/facebook.png" alt="facebook"></i></a></li>
                    </ul>
                </div>
                <div class="marche">
                    <h3>Jour de marché</h3>
                    <img src="/img/marche.jpg" alt="stand marché">
                    <p>Nous sommes régulièrement présent sur les marchés de Générac, Calvisson et Uzès avec nos cosmétiques au lait d\'ânesse :
                    <ul>
                        <li>Le vendredi matin à Générac, 1 semaine sur 2</li>
                        <li>Le samedi matin à Uzès</li>
                        <li>Le dimanche matin à Calvisson</li>
                    </ul>
                </div>
            </aside>
        </div>
        ';
    }
}