<?php

class Commande extends Database {

    private int $id=0;
    private string $spanier="";
    private int $total=0;
    private int $envoi=0;
    private string $date="";
    private string $nom="";
    private string $prenom="";
    private string $adresse1="";
    private string $adresse2="";
    private int $codepostal=0;
    private string $ville="";
    private string $email="";
    private int $tel=0;
    
    // Les méthodes
    public function getID(){
        return $this->id;
    }
    public function getSpanier(){
        return $this->spanier;
    }
    public function getTotal(){
        return $this->total;
    }
    public function getEnvoi(){
        return $this->envoi;
    }
    public function getNom(){
        return $this->nom;
    }
    public function getPrenom(){
        return $this->prenom;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getAdresse1(){
        return $this->adresse1;
    }
    public function getAdresse2(){
        return $this->adresse2;
    }
    public function getCodepostal(){
        return $this->codepostal;
    }
    public function getVille(){
        return $this->ville;
    }
    public function getTel(){
        return $this->tel;
    }
    public function getDate(){
        $timestamp = strtotime($this->date);
        $this->dateCom = date("d/m/Y \à H\hi", $timestamp);
        return $this->dateCom; 
    }

    public function setEnvoi(int $envoi)
    {
        $this->envoi = $envoi;
    }


    public function newCommande($spanier, $total, $id_cli) {
        $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $this->dateCom = $date->format('Y-m-d H:i');
        $req=$this->prepare("INSERT INTO commande (spanier, total, envoi, date, id_cli) VALUES (:spanier, :total, 0, :dateCom, :id_cli)");
        $req->bindParam(":spanier", $spanier);
        $req->bindParam(":total", $total);
        $req->bindParam(":dateCom", $this->dateCom);
        $req->bindParam(":id_cli", $id_cli);
        $req->execute();
    }

    public function upStat($id) {
        $req=$this->prepare("UPDATE commande SET envoi = 1 WHERE ID = :id");
        $req->bindParam(":id", $id);
        $req->execute();
    }

    public static function listCommande() : Array {
        $pdo = new Database();
        $req = $pdo->prepare("SELECT commande.id, spanier, total, envoi, date, nom, prenom, email, adresse1, adresse2, codepostal, ville, tel FROM commande INNER JOIN connect ON commande.id_cli = connect.id INNER JOIN client ON commande.id_cli = client.id_cli");
        $req->execute();
        return $req->fetchAll(PDO::FETCH_CLASS, "Commande");
    }

    public static function affProduitPanier($ids) : Array {
        $pdo = new Database();
        $req = $pdo->prepare("SELECT nom FROM produits WHERE id= $ids");
        $req->execute();
        $listProduitsPanier = $req->fetchAll(PDO::FETCH_CLASS, "Produits");
        return $listProduitsPanier;
    }

}

