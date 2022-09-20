<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class FormAjoutProduit {

    private string $titre='Ajouter un produit';
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
        echo
            '
            <h3>Ajouter un produit : </h3>

            <form method="post" action="AjoutNewProduits" enctype="multipart/form-data">
              <div>
                <div id="fileDisplayArea"></div>
                <input type="file" id="fileInput" name="image" accept=".jpg, .png, .gif" required>
              </div>
              <div>
                <label for="nom">Nom du produit</label>
                <input type="text" id="nom" name="nom" required/>
              </div>
              <div>
                <label for="nom">catégorie</label>
                <select name="id_cat" id="id_cat">';
                   foreach($this->liste as $catProduit) {
                      echo '<option value="'.$catProduit->getID().'">'.$catProduit->getCatNom().'</option>';
                  }
                  echo '
                </select>
                ou <a href="CatProduits">Créer une nouvelle catégorie</a>
              </div>
              <div>
                <label for="desc">Description</label>
                <textarea id="desc" id="desc" name="desc" required></textarea>
              </div>
              <div>
                <label for="prix">Prix</label>
                <input type="number" id="prix" name="prix" required>
              </div>
              <button type="submit" name="ajoutProduit" value="Upload">Ajouter ce produit</button>
            </form>
        '; 
    }
}