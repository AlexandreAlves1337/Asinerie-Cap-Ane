<?php
	class Client extends Database {
        // Les propriétés
		private int $id=0;
		private string $nom="";
		private string $prenom="";
        private string $adresse1="";
        private string $adresse2="";
        private int $codepostal=0;
        private string $ville="";
        private string $email="";
        private int $tel=0;
		private string $password="";
		private int $level=0;
        
		// Les méthodes
        public function getID(){
            return $this->id;
        }
		public function getEmail(){
			return $this->email;
		}
        public function getNom(){
            return $this->nom;
        }
        public function getPrenom(){
            return $this->prenom;
        }
        public function getAdresse1(){
            return $this->adresse1;
        }
        public function getAdresse2(){
            return $this->adresse2;
        }
        public function getCodepostal(){
            return $this->codepostal;
        }
        public function getVille(){
            return $this->ville;
        }
        public function getTel(){
            return $this->tel;
        }
		public function getLevel(){
            return $this->level;
        }

        public static function newClient ($nom, $prenom, $adresse1, $adresse2, $codepostal, $ville, $email, $tel, $motDePasse, $cpt_admin) {
            $password = password_hash($motDePasse, PASSWORD_DEFAULT);
			$lvl=0;
			if ($cpt_admin) {$lvl=1;};
			$pdo = new Database();
			$requ=$pdo->prepare("INSERT INTO connect (nom, prenom, email, password, level) VALUES (:nom, :prenom, :email, :password, $lvl)");
			$requ->bindParam(":nom", $nom);
            $requ->bindParam(":prenom", $prenom);
			$requ->bindParam(":email", $email);
			$requ->bindParam(":password", $password);
			try {
				$requ->execute();
			} catch (Exception $e) {
				return false;
			}
			$lastid = $pdo->lastInsertId();
            $req=$pdo->prepare("INSERT INTO client (adresse1, adresse2, codepostal, ville, tel, id_cli) VALUES (:adresse1, :adresse2, :codepostal, :ville, :tel, LAST_INSERT_ID())");
            $req->bindParam(":adresse1", $adresse1);
            $req->bindParam(":adresse2", $adresse2);
            $req->bindParam(":codepostal", $codepostal);
            $req->bindParam(":ville", $ville);
            $req->bindParam(":tel", $tel);
            $req->execute();
			return $lastid;
        }
		
		public static function connexion($email, $motDePasse) {					
			$pdo = new Database();
		    $requete = $pdo->prepare("SELECT * FROM connect WHERE email= :email");
			$requete->bindParam(":email", $email);
		    $requete->execute();
			$client = $requete->fetchObject("Client");
			if ($client) {
				if (!$client->verifMotDePasse($motDePasse)) {
					return false;
				}
			}
			return $client;
		}

		private function verifMotDePasse (string $motDePasse){
			return password_verify($motDePasse, $this->password);
		}

		public function upStat($id) {
			$req=$this->prepare("UPDATE connect SET level = 1 WHERE ID = :id");
			$req->bindParam(":id", $id);
			$req->execute();
		}
	
		public static function listClient() : Array {
			$pdo = new Database();
			$req = $pdo->prepare("SELECT id, nom, prenom, email, level FROM connect ORDER BY level desc, id desc");
			$req->execute();
			return $req->fetchAll(PDO::FETCH_CLASS, "Client");
		}

		public function delClient ($id) {	
			$sql = "DELETE FROM connect WHERE id = :id";
			$query = $this->prepare($sql);
			$query->bindValue(':id', $id, PDO::PARAM_INT);
			return $query->execute();
		}
	}

