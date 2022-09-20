<?php

class VueCommande extends Commande{

    private string $titre='Liste des commandes';
    private Array $liste;

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
        $this->liste = $liste;
    }

    public function html()
    {
        require '../html/menuadmin.php';
        echo '<div><h3>Liste de commandes : </h3>';
        if(empty($this->liste)) {
            echo("<p>Vous n'avez pas de commande</p>");
            } else {
        foreach($this->liste as $commande) {
            $statut = $commande->getEnvoi();
            $idq = unserialize($commande->getSpanier());
            foreach($idq as $idproduit => $quant) {
                $ola = Commande::affProduitPanier($idproduit);
                $id_produit = $ola[0]->getNom();
                echo 'produit : ' .$id_produit. '<br>
                quantité : ' .$quant. '<br>';
            };   
            echo 'Total : ' .number_format($commande->getTotal(),2,',', ' '). ' €<br> 
            Statut : ';
            if ($statut) {
                echo "<span class='valid'>Colis expédié</span><br>";
            } else {
                echo "<span class='unvalid'>Colis a expédié</span><br>
                <form method='post' action='Expedition'>
                <input type='hidden' id='idx' name='idx' value='".$commande->getID()."'>
                <button type='submit' name='validExpe' value='Upload'>Validez l'expedition</button>
                </form>";
            } echo ' Date de la commande: '.$commande->getDate().'<br>
            Adresse d\'expedition : '.$commande->getPrenom().' '.$commande->getNom().', '.$commande->getAdresse1().', '.$commande->getAdresse2().', '.$commande->getCodepostal().' '.$commande->getVille().'<br>
            Coordonnées du client : tel : '.$commande->getTel().' / Mail : '.$commande->getEmail().'</div>'; 
        };
    }
    }

}
