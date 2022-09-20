<?php

class Panier extends Database {

    public static function ajoutPanier($id_produit) {
        if (isset($_SESSION['panier'][$id_produit])) {
            $_SESSION['panier'][$id_produit]++;
        } else {           
            $_SESSION['panier'][$id_produit] = 1;
        }
    }

    public static function enleverPanier($id_produit) {
        if ($_SESSION['panier'][$id_produit]>1) {
            $_SESSION['panier'][$id_produit]--;
        } else {           
            $_SESSION['panier'][$id_produit] = 1;
        }
    }


    public static function affProduitPanier($ids) : Array {
        $pdo = new Database();
        $req = $pdo->prepare('SELECT * FROM produits WHERE id IN ('.implode(',',$ids).')');
        $req->execute();
        $listProduitsPanier = $req->fetchAll(PDO::FETCH_CLASS, "Produits");
        return $listProduitsPanier;
    }

    public static function ajouterProduitPanier($recupId_panier) {
        $pdo = new Database($data=array());
        $req = $pdo->prepare("SELECT id, nom FROM produits WHERE id= $recupId_panier", array('id' => $recupId_panier));
        $req->execute($data);
        return $req->fetchAll(PDO::FETCH_OBJ);
    }

}

