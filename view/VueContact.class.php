<?php
class VueContact {

    private string $titre='Contact';
    private Array $liste;

    public function __construct(Array $liste) {
       $this->liste = $liste;
    }

    public function getTitre(){
        echo $this->titre;
    }

    public function html()
    {
        require '../html/menuadmin.php';
        echo '<div><h3>Les contacts : </h3>';
            if(empty($this->liste)) {
            echo("<p>Vous n'avez pas de nouveau message</p>");
            } else {
            foreach($this->liste as $contact) {
                date_default_timezone_set('Europe/Paris');
                echo '
                Message reçu le '.$contact->getDate().'<br>
                Nom : '.$contact->getNom().'<br>
                Prénom : '.$contact->getPrenom().'<br>
                mail : '.$contact->getEmail().'<br>
                téléphone : '.$contact->getTel().'<br>
                Message : '.$contact->getMessage().'<br>
                <a href="DelContact?id='.$contact->getID().'"><button>Supprimer ce message</button></a>';
            };
        }
    }
}