<?php
	class CatProduits extends Database {
        // Les propriétés
		private int $id=0;
		private string $catNom="";

		// Les méthodes
        public function getID(){
            return $this->id;
        }

		public function getCatNom(){
			return $this->catNom;
		}

        public function ajouterCatProduits ($cat) {
               $req=$this->prepare("INSERT INTO catproduits (catNom) VALUES (:cat)");
               $req->bindParam(":cat", $cat);
               $req->execute();
        }

		// Méthode pour modifier le nom de d'un thème dans la base de données
		// Method to change the name of a theme in the database
		public function modifTheme ($id, $theme) {	
			$sql = "UPDATE themes SET theme=:theme WHERE themes.id= :id";
			$query = $this->prepare($sql);
			$query->bindValue(':id', $id);
			$query->bindValue(':theme', $theme);
			return $query->execute();
		}
	}
