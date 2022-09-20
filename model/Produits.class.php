
<?php
	class Produits extends Database {
        // Les propriétés
		private int $id=0;
		private string $image="";
		private string $nom="";
		private int $id_cat=0;
        private int $prix=0;
		private string $description="";
        private string $catNom="";
		private int $activ=0;

        
		// Les méthodes
        public function getID(){
            return $this->id;
        }
		public function getImage(){
			return $this->image;
		}
        public function getNom(){
            return $this->nom;
        }
		public function getPrix(){
			return $this->prix; 
		}
        public function getDesc(){
			return $this->description;
		}
		public function getId_cat(){
			return $this->id_cat;
		}
        public function getCatNom(){
			return $this->catNom;
		}
		public function getActiv(){
			return $this->activ;
		}

        public function ajouterProduits($image, $nom, $id_cat, $prix, $desc) {
            $req=$this->prepare("INSERT INTO produits (image, nom, id_cat, prix, description, activ) VALUES (:image, :nom, :id_cat, :prix, :desc, 1)");
            $req->bindParam(":image", $image);
            $req->bindParam(":nom", $nom);
            $req->bindParam(":id_cat", $id_cat);
            $req->bindParam(":prix", $prix);
            $req->bindParam(":desc", $desc);
            $req->execute();
        }

		public function disProd($id) {
			$req=$this->prepare("UPDATE produits SET activ = 0 WHERE ID = :id");
			$req->bindParam(":id", $id);
			$req->execute();
		}

		public function reactivProd($id) {
			$req=$this->prepare("UPDATE produits SET activ = 1 WHERE ID = :id");
			$req->bindParam(":id", $id);
			$req->execute();
		}

        public static function listProduits($selectCat) : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT produits.id, image, nom, id_cat, prix, description, activ, catNom  FROM produits INNER JOIN catproduits on catproduits.id = produits.id_cat $selectCat");
            $req->execute();
            $listProduits = $req->fetchAll(PDO::FETCH_CLASS, "Produits");
            return $listProduits;
        }

        public static function listCatProduits() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT * FROM catproduits");
            $req->execute();
            $listCatProduits = $req->fetchAll(PDO::FETCH_CLASS, "CatProduits");
            return $listCatProduits;
        }

		public static function countCatProduits() {
			$pdo = new Database();
            $req = $pdo("SELECT COUNT(*) FROM produits");
            return $req;
        }

		// Méthode pour créer un nouveau post dans la base de données
		// Method to create a new post in the database
		public static function newSujet ($title, $text, $id_theme) {			
			$pdo = new Database();
		    $requete = $this->prepare("INSERT INTO posts (title, text, id_theme) VALUES (:title, :text, :id_theme)");
			$requete->bindParam(":title", $title);
			$requete->bindParam(":text", $text);
			$requete->bindParam(":id_theme", $id_theme);
			try {
				$requete->execute();
			} catch (Exception $e) {
				return false;
			}
		}

		// Méthode pour supprimer un post dans la base de données
		// Method to delete a post from the database
		public function deleteSujet ($id) {	
			$sql = "DELETE FROM posts WHERE posts.id = :id";
			$query = $this->prepare($sql);
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			return $query->execute();
		}

		// Méthode qui renvoi la liste des themes non assigné à un post enregistrés dans la base de données
		// Method that returns the list of theme not assigned to a post registered in the database
		public static function listThemes() : Array {
            $dbh = new Database();
            $sql = "SELECT * FROM themes WHERE id NOT IN (SELECT id_theme FROM posts)";
            $sth = $dbh->prepare($sql);
            $sth->execute();
            $listThemes = $sth->fetchAll(PDO::FETCH_CLASS, "Theme");
            return $listThemes;
        }

		// Méthode qui renvoi une liste des posts enregistrés dans la base de données
		// Method that returns a list of posts registered in the database

	}