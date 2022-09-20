<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class Location{

    private string $titre='Location d\'ânes bâtés';

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
      $this->liste = $liste;
   }

    public function html()
    {

        echo '
        <h3>Location d\'ânes bâtés</h3>
            <section class="accueil">
                <div class="texte">
                    <p>Nous mettons à votre disposition à la location des ânes bâtés.</p>
                    <p>Au-delà de l\'expression populaire et péjorative qui désigne une personne peu sot, un âne bâté, dans son sens propre, est un âne équipé d\'une selle de bât et de sacoches.</p>
                    <p>L\'objectif premier est de transporter les bagages de plusieurs personnes sur de longues distances.</p>
                    <p>Alors si vous avez un projet de ce type, nous serons ravis de vous accompagner dans cette aventure.</p>
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