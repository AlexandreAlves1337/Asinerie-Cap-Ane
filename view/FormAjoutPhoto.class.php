<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class FormAjoutPhoto {

    private string $titre='Ajouter des photos';
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
            <h3>Ajouter une photo : </h3>

            <form method="post" action="AjoutNewPhotos" enctype="multipart/form-data">
              <div>
                <label for="id_cat">Choisissez la page concerné :</label>
                  <select name="id_cat" id="id_cat">';
                    foreach($this->liste as $catPage) {
                        echo '<option value="'.$catPage->getID().'">'.$catPage->getcatNom().'</option>';
                    }
                    echo '
                  </select>
              </div>
              <div class="descriptionPage">
                <label for="descpage" id="labeldp"></label>
                <textarea id="descpage" name="descpage"></textarea>
              </div>
              <div>
                <label for="image" id="label1">Sélectionnez la photo que vous souhaitez ajouter :</label>
                <input type="file" id="fileInput" name="image" accept=".jpg, .png, .gif" required>
                <div id="fileDisplayArea"></div>
              </div>
              <div class="photot">
                <label for="imaget" id="label2">Sélectionnez la photo après :</label>
                <input type="file" id="fileInputt" name="imaget" accept=".jpg, .png, .gif">
                <div id="fileDisplayAreat"></div>
              </div>
              <div class="photopage">
                <label for="photopage">Faire apparaitre cette photo en page d\'accueil ?</label>
                <input type="checkbox" id="photopage" name="photopage" value="1">
              </div>
              <button type="submit" name="ajoutPhoto" id="ajoutPhoto" value="Upload">Ajouter cette photo</button>
            </form>
        '; 
    }
}