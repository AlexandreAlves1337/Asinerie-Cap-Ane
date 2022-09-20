<?php

class DisableProd extends Produits {

    private string $titre='Liste des produits désactivés';
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
        echo '<div><h3>Liste des produits désactivés : </h3>';
        if (!empty($this->liste)) {
        foreach($this->liste as $produit) {
            echo $produit->getNom().'<br>'
            .$produit->getPrix().'<br>
            <a class="valid" href="ReactivProd?id='.$produit->getID().'"><i title="Résactivez ce produit" class="valid fa-solid fa-check"></i></a><br>';
        };
    } else {echo "Il n'y a pas de produit désactivé pour le moment. Allez sur la page <a href=\"/Boutique\">boutique</a> si vous souhaitez désactiver un produit";}
    }
    

}
