<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class Balade {

    private string $titre='Balade à dos d\'âne';

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
      $this->liste = $liste;
   }

    public function html()
    {

        echo '
        <h3>Balades à dos d\'ânes</h3>
            <section class="accueil">
                <div class="texte">
                    <div>
                        <p>L\'asinerie Cap Âne vous propose la location d\'un âne équipé d\'une selle pour le confort et la sécurité de vos enfants pendant votre balade, toute l\'année.</p>
                        <p>Sur un parcours balisé de 3 kms environ autour de l\'asinerie, vous partez en toute autonomie avec un âne équipés, dans un chemin de randonnée pour une balade d\'une heure environ</p>
                        <p>Pensez à prendre casquette, crème solaire, chaussures adaptées pour la marche, eau et éventuellement crème anti moustique.</p>
                    </div>
                    <div class="balade">
                        <div class="balade_ht">
                            <p>Jour d\'ouverture et horaires d\'été :</p>
                            <ul>
                                <li>Lundi fermé</li>
                                <li>Mardi de 8h à 11h30</li>
                                <li>Mercredi de 8h à 11h30</li>
                                <li>Jeudi de 15h à 16h30</li>
                                <li>Vendredi</li>
                                <li>Samedi de 15h30 à 19h00</li>
                                <li>Dimanche de 15h30 à 19h00</li>
                            </ul>
                            <p>sur rendez-vous uniquement</p>
                        </div>
                        <div class="balade_ht">
                            <p>Tarifs :</p>
                            <ul>
                                <li>Parcour initiation (5min environ) : 3€</li>
                                <li>Parcour 50min environ : 15€</li>
                                <li>Parcour 1h05 environ : 15€</li>
                            </ul>
                            <p>D\'autre parcours seront mis en place prochainements. Nous vous attendons avec impatience pour de nouvelles aventures.</p>
                        </div>
                    </div>
                    <div>
                        <p>En cette période de pandémie lees balades se font uniquement sur réservation téléphonique pour respecter les gestes barrières et les disponibilités. Il est également souhaitable de prévoir le casque ou bombe de vos enfants. Merci de votre compréhension.</p>
                    </div>
                </div>
                <div class="carouselContainer">
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
        </div>
        ';
    }
}