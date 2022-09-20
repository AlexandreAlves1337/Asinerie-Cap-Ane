<?php

class VueClient extends Client{

    private string $titre='Liste des clients';
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
        echo '<div><h3>Liste des clients : </h3>';
        if (count($this->liste)>1) {
        foreach($this->liste as $client) {
            $level = $client->getLevel(); 
            echo $client->getPrenom().'<br>'
            .$client->getNom().'<br>'
            .$client->getEmail().'<br>';
            if ($level==0) {
                echo "<span class='valid'>Compte client</span>
                <a href=\"Uplevel?id=".$client->getID()."\"><button>Passez ce compte en administrateur</button></a>
                <a href=\"DelCli?id=".$client->getID()."\"><button>Effacer ce compte</button></a>";
            } else {
                echo "<span class='unvalid'>Compte administrateur</span><br>
                <a href=\"DelCli?id=".$client->getID()."\"><button>Effacer ce compte</button></a>";
            }; 
        };
    } else {echo "Il faut conserver au moins un compte utilisateur";}
    }
    

}
