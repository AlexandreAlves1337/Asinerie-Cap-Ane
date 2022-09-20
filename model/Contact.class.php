
<?php
class Contact extends Database {
    // Les propriétés
    private int $id=0;
    private string $nom="";
    private string $prenom="";
    private string $email="";
    private int $tel=0;
    private string $date="";
    private string $message="";

    
    // Les méthodes
    public function getID(){
        return $this->id;
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
    public function getTel(){
        return $this->tel; 
    }
    public function getMessage(){
        return $this->message;
    }
    public function getDate(){
        $timestamp = strtotime($this->date);
        $this->dateContact = date("d/m/Y \à H\hi", $timestamp);
        return $this->dateContact; 
    }

    public function newContact ($nom, $prenom, $email, $tel, $message) {
        $date = new DateTime('now', new DateTimeZone('Europe/Paris'));
        $this->dateContact = $date->format('Y-m-d H:i');
        $req=$this->prepare("INSERT INTO contact (nom, prenom, email, tel, message, date) VALUES (:nom, :prenom, :email, :tel, :message, :dateContact)");
        $req->bindParam(":nom", $nom);
        $req->bindParam(":prenom", $prenom);
        $req->bindParam(":email", $email);
        $req->bindParam(":tel", $tel);
        $req->bindParam(":message", $message);
        $req->bindParam(":dateContact", $this->dateContact);
        $req->execute();
    }

    public static function listContact() : Array {
        $pdo = new Database();
        $req = $pdo->prepare("SELECT * FROM contact ORDER BY date DESC");
        $req->execute();
        $listContact = $req->fetchAll(PDO::FETCH_CLASS, "Contact");
        return $listContact;
    }

    public function delContact ($id) {	
        $sql = "DELETE FROM contact WHERE id = :id";
        $query = $this->prepare($sql);
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        return $query->execute();
    }
}