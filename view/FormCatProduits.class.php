<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class FormCatProduits {

    private string $titre='Ajouter une catégorie';

    public function getTitre(){
        echo $this->titre;
    }

    public function html()
    {
        require '../html/menuadmin.php';
        echo
            '
            <h3>Ajouter une catégorie : </h3>

            <form action="AjoutCatProduits" method="POST">
              <label for="cat"> Nom de la catégorie : </label>
              <input type="text" name="cat" placeholder="Nom de la catégorie" required="required"/>
              <button type="submit" name="ajoutCatProduit">Ajouter cette catégorie</button>
            </form>
        '; 
    }
}