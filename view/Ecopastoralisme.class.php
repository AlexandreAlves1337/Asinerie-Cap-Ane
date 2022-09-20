<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class Ecopastoralisme{

    private string $titre='Ecopastoralisme';

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
      $this->liste = $liste;
   }

    public function html()
    {

        echo '
        <h3>Ecopastoralisme</h3>
            <section class="accueil">
                <div class="texte">
                    <p>L\'écopastoralisme ou éco-pâturage est un mode d\'entretien écologique des espaces naturels et des territoires par le pâturage d\'animaux herbivores.</p>
                    <p>Nos ânes peuvent être utilisé pour un débroussaillage naturel et écologique de vos terrains.</p>
                    <p>Voici quelques exemples de chantier avant le passage de nos ânes et après :</p>
                </div>';
                if (empty($this->liste)) {
                    echo '
                    <p class="center unvalid">Ooups! Nous n\'avons pour l\'instant aucun exemple à vous montrer. On corrige ça très vite</p>';
                } else {
                    foreach($this->liste as $photo) {
                    echo '
                    <div class="ecopas">
                        <p>'.$photo->getDescpage().'</p>
                        <div class="chantier">
                            <figure>
                                <img src="img/bibli/Photo_'.$photo->getPhoto().'">
                                <figcaption>Avant</figcaption>
                            </figure>
                            <figure>
                                <img src="img/bibli/Photo_'.$photo->getPhoto2().'">
                                <figcaption>Après</figcaption>
                            </figure>
                        </div>
                    </div>';
                    };
                };
                echo '
            </section>';
    }
}