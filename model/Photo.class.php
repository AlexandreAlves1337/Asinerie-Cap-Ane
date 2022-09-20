<?php
	class Photo extends Database {
        // Les propriétés
		private int $id=0;
		private string $photo="";
		private string $photo2="";
		private string $descpage="";
		private int $page=0;
        private bool $accueil=false;
        private string $catNom="";
        
		// Les méthodes
        public function getID(){
            return $this->id;
        }
		public function getPhoto(){
			return $this->photo;
		}
		public function getPhoto2(){
			return $this->photo2;
		}
		public function getDescpage(){
            return $this->descpage;
        }
        public function getPage(){
            return $this->page;
        }
		public function getAccueil(){
			return $this->accueil; 
		}
        public function getCatNom(){
			return $this->catNom; 
		}

        public function ajouterPhoto($photo, $photo2, $descpage, $page, $accueil) {
            $req=$this->prepare("INSERT INTO photo (photo, photo2, descpage, page, accueil) VALUES (:photo, :photo2, :descpage, :page, :accueil)");
            $req->bindParam(":photo", $photo);
			$req->bindParam(":photo2", $photo2);
			$req->bindParam(":descpage", $descpage);
            $req->bindParam(":page", $page);
            $req->bindParam(":accueil", $accueil);
            $req->execute();
        }

        public static function listCarouselAcc() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT id, photo FROM photo WHERE accueil=1");
            $req->execute();
            $listCarAcc = $req->fetchAll(PDO::FETCH_CLASS, "Photo");
            return $listCarAcc;
        }

		public static function listCarouselBalade() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT id, photo FROM photo WHERE page=2");
            $req->execute();
            $listCarBal = $req->fetchAll(PDO::FETCH_CLASS, "Photo");
            return $listCarBal;
        }

		public static function listCarouselLoc() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT id, photo FROM photo WHERE page=3");
            $req->execute();
            $listCarLoc = $req->fetchAll(PDO::FETCH_CLASS, "Photo");
            return $listCarLoc;
        }

		public static function listVente() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT id, photo, descpage FROM photo WHERE page=4 ORDER BY id desc");
            $req->execute();
            $listVnt = $req->fetchAll(PDO::FETCH_CLASS, "Photo");
            return $listVnt;
        }

		public function delVente ($id) {	
			$sql = "DELETE FROM photo WHERE id = :id";
			$query = $this->prepare($sql);
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			return $query->execute();
		}

		public static function listEcoPast() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT id, photo, photo2, descpage FROM photo WHERE page=5 ORDER BY id desc");
            $req->execute();
            $listEcp = $req->fetchAll(PDO::FETCH_CLASS, "Photo");
            return $listEcp;
        }

        public static function listPage() : Array {
            $pdo = new Database();
            $req = $pdo->prepare("SELECT * FROM catpage");
            $req->execute();
            $listPage = $req->fetchAll(PDO::FETCH_CLASS, "Photo");
            return $listPage;
        }
	}