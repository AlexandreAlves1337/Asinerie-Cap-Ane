<?php

class Inscription {

    private string $titre='Inscription';

    public function getTitre(){
        echo $this->titre;
    }
    
    public function html(){

        $errormdpi = "";
        if (isset ($_SESSION["errormdpi"])) {
                $errormdpi = "<p class='unvalid'>";
                $errormdpi .= $_SESSION["errormdpi"];
                $errormdpi .= "</p><br>";
            }
        $errormaili = "";
        if (isset($_SESSION["errormaili"])) {
                $errormaili = "<p class='unvalid'>";
                $errormaili .= $_SESSION["errormaili"];
                $errormaili .= "</p><br>";
            }

        echo
        '
        <p class="titre_connect">Choisissez vos identifiants et votre adresse de livraison</p>
        <p class="center">les champs avec un astérisque sont obligatoire</p>
            <form method="POST" action="Tclient">
            <input type="hidden" name="pmar">
            <div class="inscription">
                <div class="insc">
                    <p class="titre_connect">Identifiant</p>
                    <label for="email">*Email : </label>
                    <input type="email" name="email" id="email" placeholder="Entrez votre email" required/><br>
                    '.$errormaili.'
                    <label for="password">*Mot de Passe : </label>
                    <input type="password" name="password" id="password" placeholder="Entrez votre mot de passe" required/>
                    <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span><br>
                    <label for="repassword">*Mot de Passe : </label>
                    <input type="password" name="repassword" id="repassword" placeholder="Confirmez votre mot de passe" required/>
                    <span toggle="#repassword" class="fa fa-fw fa-eye field-icon toggle-repassword"></span><br>
                    '.$errormdpi.'
                </div>
                <div class="insc">
                    <p class="titre_connect">Information de livraison</p>
                    <label for="nom">*Nom : </label>
                    <input type="text" name="nom" id="nom" placeholder="Entrez votre nom" required/><br>
                    <label for="prenom">*Prénom : </label>
                    <input type="text" name="prenom" id="prenom" placeholder="Entrez votre prénom" required/><br>
                    <label for="adresse1">*Adresse : </label>
                    <input type="text" name="adresse1" id="adresse1" placeholder="Entrez votre adresse" required/><br>
                    <label for="adresse2">Complement d"adresse : </label>
                    <input type="text" name="adresse2" id="adresse2" placeholder="Entrez votre complément d\'adresse" /><br>
                    <label for="codepo">*Code Postal : </label>
                    <input type="text" name="codepo" id="codepo" placeholder="Entrez votre code postal" required/>
                    <label for="ville">*Ville : </label>
                    <input type="text" name="ville" id="ville" placeholder="Entrez votre ville" required/><br>
                    <label for="tel">*Téléphone : </label>
                    <input type="tel" id="tel" name="tel" placeholder="Votre numéro de téléphone" required>
                </div>
            </div>
            <div class="btn_insc"><input type="submit" name="inscription" value="Inscription"></div>
            </form>
        

        '; 
    }
}
