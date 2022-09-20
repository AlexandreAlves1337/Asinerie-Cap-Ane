<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class Vente{

    private string $titre='Vente d\'ânes';

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
      $this->liste = $liste;
   }

    public function html()
    {

        echo '
        <h3>Vente d\'ânes</h3>
            <section class="accueil">
                <div class="texte">
                    <p class="center">Nous proposons, le cas échéant, des ânes à la vente. N\'hésitez à nous contacter si vous voulez plus de renseignement.</p>
                </div>';
                if (empty($this->liste)) {
                    echo '
                    <p class="center unvalid">Nous n\'avons pour l\'instant aucun de nos ânes à la vente</p>';
                } else {
                echo'
                <div class="vente">';
                    foreach($this->liste as $photo) {
                    echo '
                    <div class="vente_u">
                        <img src="img/bibli/Photo_'.$photo->getPhoto().'">
                        <p>'.$photo->getDescpage().'</p>';
                        if ($_SESSION["level"]==1) {
                        echo '
                        <a class="button" href="DelVente?id='.$photo->getID().'">Vendu</a>';
                        };
                    echo '
                    </div>';
                    };
                };
                echo '
                </div>
            </section>';
    }
}