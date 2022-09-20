<?php

class Connexion {

    private string $titre='Connexion';

    public function getTitre(){
        echo $this->titre;
    }
    
    public function html(){

        $errormdp = "";
        if (isset ($_SESSION["errormdp"])) {
                $errormdp = "<p class='unvalid'>";
                $errormdp .= $_SESSION["errormdp"];
                $errormdp .= "</p><br>";
            }
        $errormail = "";
        if (isset($_SESSION["errormail"])) {
                $errormail = "<p class='unvalid'>";
                $errormail .= $_SESSION["errormail"];
                $errormail .= "</p><br>";
            }

        echo
        '
        <p class="titre_connect">Saisissez vos identifiants de connexion</p>
        <div class="connexion">
            <form method="POST" action="Tconnect">
                <label for="email">Votre email : </label>
                <input type="email" name="email" id="email" placeholder="Entrez votre email" required/><br>
                '.$errormail.'
                <label for="password">Choisissez votre mot de Passe : </label>
                <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required/>
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span><br>
                '.$errormdp.'
                <input type="submit" name="connexion" value="Connexion">
            </form>
        </div>

            <p class="lien_ins"><a href="/Inscription">Creer un compte</a></p>

        '; 
    }
}
