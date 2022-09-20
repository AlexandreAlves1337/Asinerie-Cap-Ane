<?php
if(!isset($_SESSION)) {
    session_start();
}
if(!isset($_SESSION['panier'])) {
    $_SESSION['panier']=[];
}

require '../model/Database.class.php';
require '../model/CatProduits.class.php';
require '../model/Produits.class.php';
require '../model/Panier.class.php';
require '../model/Commande.class.php';
require '../model/Contact.class.php';
require '../model/Client.class.php';
require '../model/Photo.class.php';
require '../view/FormCatProduits.class.php';
require '../view/FormAjoutProduit.class.php';
require '../view/FormAjoutPhoto.class.php';
require '../view/Boutique.class.php';
require '../view/DisableProd.class.php';
require '../view/VuePanier.class.php';
require '../view/VueCommande.class.php';
require '../view/VueContact.class.php';
require '../view/Inscription.class.php';
require '../view/Connexion.class.php';
require '../view/VueClient.class.php';
require '../view/Accueil.class.php';
require '../view/Balade.class.php';
require '../view/Location.class.php';
require '../view/Vente.class.php';
require '../view/Ecopastoralisme.class.php';


$url = filter_input(INPUT_GET, "url"); 

switch($url) {

    // Page de connexion
    case "Connexion": 
        $page = new Connexion();
    break;
    
    // Traitement du formulaire de connexion
    case "Tconnect" :
        unset($_SESSION["errormail"]);
        $email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $password=filter_input(INPUT_POST, 'password');
        $client = Client::connexion($email,$password);
        if($client){
            $id_cli=$client->getID();
            $nom=$client->getNom();
            $prenom=$client->getPrenom();
            $level=$client->getLevel();
            $_SESSION["id_cli"]=$id_cli;
            $_SESSION["nom"]=$nom;
            $_SESSION["prenom"]=$prenom;
            $_SESSION["level"]=$level;
                if (isset($_SESSION['panier']) && !empty($_SESSION['panier'])){
                    header('Location: /Panier');
                } else {
                    header('Location: /');}
        }else{
            $_SESSION["errormdp"] = "Cette combinaison adresse email / mot de passe ne correspond à aucun compte.<br>Si le problème persiste, n'hésitez pas à nous contacter";
            header('Location: /Connexion');
        }
    break;

    // Page d'inscription
    case "Inscription" :
        unset($_SESSION["errormdp"]);
        $page = new Inscription();
    break;

    // Traitement du formulaire d'inscription
    case "Tclient" :
        unset($_SESSION["errormaili"]);
        unset($_SESSION["errormdpi"]);
        if (isset($_POST['inscription'])) {
            if(isset($_POST['pmar']) && empty($_POST['pmar'])) {
                if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['adresse1']) AND isset($_POST['codepo']) AND isset($_POST['ville']) AND isset($_POST['email']) AND isset($_POST['tel']) AND isset($_POST['password']) AND isset($_POST['repassword'])) {
                    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['adresse1']) AND !empty($_POST['codepo']) AND !empty($_POST['ville']) AND !empty($_POST['email']) AND !empty($_POST['tel']) AND !empty($_POST['password'])) {
                        $nom=filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $prenom=filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $adresse1=filter_input(INPUT_POST, 'adresse1', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $adresse2=filter_input(INPUT_POST, 'adresse2', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $codepostal=filter_input(INPUT_POST, 'codepo', FILTER_SANITIZE_NUMBER_INT);
                        $ville=filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                        $tel=filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
                        $password=filter_input(INPUT_POST, 'password');
                        $repassword=filter_input(INPUT_POST, 'repassword');
                        if ($password != $repassword) {
                            $_SESSION["errormdpi"] = "les deux mots de passe ne sont pas identiques";
                            header('Location: /Inscription');
                        } else {
                        $cpt_admin = False;
                        $reVal = Client::newClient($nom, $prenom, $adresse1, $adresse2, $codepostal, $ville, $email, $tel, $password, $cpt_admin);
                            if($reVal){
                                $client = Client::connexion($email, $password);
                                $id_cli=$client->getID();
                                $nom=$client->getNom();
                                $prenom=$client->getPrenom();
                                $level=$client->getLevel();
                                $_SESSION["id_cli"]=$id_cli;
                                $_SESSION["nom"]=$nom;
                                $_SESSION["prenom"]=$prenom;
                                $_SESSION["level"]=$level;
                                header('Location: /');
                            }else{
                                unset($_SESSION["id_cli"]);
                                $_SESSION["errormaili"] = "l'adresse email saisie est déjà utilisée<br>Pour vous connecter <a href=\"/Connexion\">Cliquez ici</a>";
                                header('Location: /Inscription');
                            }
                        }
                    }
                }
            }
        }
    break;

    // !Page admin! Page listant les contacts 
    case "Contact" :
        if ($_SESSION["level"]==1) {
            $listcontacts = Contact::listContact();
            $page = new VueContact($listcontacts);
        } else {
            header("location: /");
        }
    break;

    // Traitement du formulaire de contact
    case "Tcontact" :
        if (isset($_POST['contact'])) {
            if(isset($_POST['pmar']) && empty($_POST['pmar'])) {
                if(isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['email']) AND isset($_POST['tel']) AND isset($_POST['message'])) {
                    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['email']) AND !empty($_POST['tel']) AND !empty($_POST['message'])) {
                        $nom=filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $prenom=filter_input(INPUT_POST, 'prenom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $email=filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                        $tel=filter_input(INPUT_POST, 'tel', FILTER_SANITIZE_NUMBER_INT);
                        $message=filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $anc = new Contact;
                        $anc->newContact($nom, $prenom, $email, $tel, $message);
                    }
                }
            }
        }
        header("location: /");
    break;

    // Traitement en cas de suppression d'un message reçu via le formulaire de contact
    case "DelContact" :
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $delcont = new Contact;
        $delcont->delContact($id);
        header("location: /Contact");
    break;

    // Page d'affichage du panier
    case "Panier" :
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $listProduitsPanier = [];
        } else {
            $listProduitsPanier = Panier::affProduitPanier($ids);
        }
        $page = new VuePanier($listProduitsPanier);
    break;

    // Traitement en cas de suppression d'un produit dans le panier depuis la vue du panier
    case "DeletePanier" :
        $recupId_del = filter_input(INPUT_GET, "del", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        if ($recupId_del) {
            unset ($_SESSION['panier'][$recupId_del]);
        }
        header("location: /Panier");
    break;

    // Traitement en cas d'ajout d'un produit dans le panier depuis la page boutique ou de modification de la quantité en positif depuis la page panier
    case "AjoutPanier" :
        $recupId_boutique = filter_input(INPUT_GET, "idb", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        $recupId_panier = filter_input(INPUT_GET, "idp", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
            if ($recupId_boutique) {
                $app = Panier::ajouterProduitPanier($recupId_boutique);
                if(empty($app)) {
                    die("Ce produit n'existe pas");
                } else {
                $id_produit = $app[0]->id;
                $lol = Panier::ajoutPanier($id_produit);
                }
            } 
            else if ($recupId_panier) {
                $app = Panier::ajouterProduitPanier($recupId_panier);
                if(empty($app)) {
                    die("Ce produit n'existe pas");
                } else {
                $id_produit = $app[0]->id;
                $lol = Panier::ajoutPanier($id_produit);
                }
            } 
    break;

    // Traitement en cas de modification de la quantité en négatif depuis la page panier
    case "EnleverPanier" :
        $recupId_panier = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        if ($recupId_panier) {
            $app = Panier::ajouterProduitPanier($recupId_panier);
            if(empty($app)) {
                die("Ce produit n'existe pas");
            } else {
            $id_produit = $app[0]->id;
            $lol = Panier::enleverPanier($id_produit);
            }
        } 
    break;

    // Traitement en cas de validation du panier
    case "Panier-valid" :
        if (isset($_POST['validPanier'])) {
            if(isset($_POST['sPanier']) && ($_POST['total']) && ($_POST['id_cli'])) {
                if(!empty($_POST['sPanier']) && !empty($_POST['total']) && !empty($_POST['id_cli'])) {
                    $sPanier=filter_input(INPUT_POST, 'sPanier', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $total=filter_input(INPUT_POST, 'total', FILTER_SANITIZE_NUMBER_INT);
                    $id_cli=filter_input(INPUT_POST, 'id_cli', FILTER_SANITIZE_NUMBER_INT);
                    $acp = new Commande;
                    $acp->newCommande($sPanier, $total, $id_cli);
                    unset($_SESSION['panier']);
                }
            }
        }
        header("location: /Boutique");
    break;
    
    // !Page admin! Page listant les commandes
    case "Liste-des-commandes" :
        if ($_SESSION["level"]==1) {
            $listeCommande = Commande::listCommande();
            $page = new VueCommande($listeCommande);
        } else {
            header("location: /");
        }
    break;

    // Traitement en cas de changement d'état de l'expedition d'un commande
    case "Expedition" :
        if (isset($_POST['validExpe'])) {
            $id=filter_input(INPUT_POST, 'idx', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $expe = new Commande;
            $expe->upStat($id);
        }
        header('Location: /Liste-des-commandes');
    break;

        // !Page admin! Page listant les clients
    case "Liste-des-clients" :
        if ($_SESSION["level"]==1) {
            $listeClient = Client::listClient();
            $page = new VueClient($listeClient);
        } else {
            header("location: /");
        }
    break;

    // Traitement en cas de changement de niveau d'un client (admin)
    case "Uplevel" :
        $id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $admcli = new Client;
        $admcli->upStat($id);
        header('Location: /Liste-des-clients');
    break;

        // Traitement en cas de suppression d'un client
    case "DelCli" :
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $delcli = new Client;
        $delcli->delClient($id);
        header("location: /Liste-des-clients");
    break;

    // Page Boutique
    case "Boutique" :
        $recupId_cat = filter_input(INPUT_GET, "cat", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
        if ($recupId_cat) {
            $retest = explode("_", $recupId_cat);
            $id_cat = $retest[0];
            $cat_nom = $retest[1];
            $selectCat="WHERE catproduits.id = $id_cat AND activ = 1 ";
        } else {
            $selectCat="WHERE activ = 1";
            $cat_nom = "";
        }
        $listProduits = Produits::listProduits($selectCat);
        $listCatProduits = Produits::listCatProduits();
        $ids = array_keys($_SESSION['panier']);
        if (empty($ids)) {
            $listProduitsPanier = [];
        } else {
            $listProduitsPanier = Panier::affProduitPanier($ids);
        }
        $page = new Boutique($listProduits, $listCatProduits, $listProduitsPanier, $cat_nom);
    break;

    // Traitement en cas de desactivation d'un produit
    case "DesactivProd" :
        $id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $desprod = new Produits;
        $desprod->disProd($id);
        header('Location: /Boutique');
    break;

    // !Page admin! Page ou on liste les produits désactivés
    case "Liste-des-produits-desactives" :
        if ($_SESSION["level"]==1) {
            $selectCat="WHERE activ = 0";
            $listProduits = Produits::listProduits($selectCat);
            $page = new DisableProd($listProduits);
        } else {
            header("location: /");
        }
    break;

    // Traitement en cas de réactivation d'un produit
    case "ReactivProd" :
        $id=filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
        $desprod = new Produits;
        $desprod->reactivProd($id);
        header('Location: /Liste-des-produits-desactives');
    break;

    // !Page admin! Page du formulaire de création d'une catégorie de produit 
    case "CatProduits" :
        if ($_SESSION["level"]==1) {
            $page = new FormCatProduits;
        } else {
            header("location: /");
        }
    break;

    // Traitement du formulaire de création d'une catégorie de produit
    case "AjoutCatProduits" :
        if (isset($_POST['ajoutCatProduit'])) {
            if(isset($_POST['cat'])) {
                if(!empty($_POST['cat'])) {
                    $cat=filter_input(INPUT_POST, 'cat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $acp = new CatProduits;
                    $acp->ajouterCatProduits($cat);
                }
            }
        }
        header('Location: /AjoutProduits');
    break;

    // !Page admin! Page du formulaire pour ajouter des nouveaux produits dans la boutique
    case "AjoutProduits" :
        if ($_SESSION["level"]==1) {
            $listCatProduits = Produits::listCatProduits();
            $page = new FormAjoutProduit($listCatProduits);
        } else {
            header("location: /");
        }
    break;

    // Traitement du formulaire de création d'un nouveau produit
    case "AjoutNewProduits" :
        if (isset($_POST['ajoutProduit'])) {
            if(is_array($_FILES) AND isset($_POST['nom']) AND isset($_POST['prix']) AND isset($_POST['desc'])) {
                if(!empty($_POST['nom']) AND !empty($_POST['prix']) AND !empty($_POST['desc'])) {
                    if(is_array($_FILES)) {
                        $uploaded_file = $_FILES['image']['tmp_name']; 
                        $upl_img_properties = getimagesize($uploaded_file);
                        $file_name_id=uniqid('', true);
                        $folder_path = "img/produits/";
                        $img_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                        $image_type = $upl_img_properties[2];
                
                        switch ($image_type) {
                            //for PNG Image
                            case IMAGETYPE_PNG:
                                $image_type_id = imagecreatefrompng($uploaded_file); 
                                $target_layer = image_resize($image_type_id, $upl_img_properties, $upl_img_properties[0], $upl_img_properties[1]);
                                imagepng($target_layer, $folder_path. $file_name_id. "_MIN.". $img_ext);
                                break;
                            //for GIF Image
                            case IMAGETYPE_GIF:
                                $image_type_id = imagecreatefromgif($uploaded_file); 
                                $target_layer = image_resize($image_type_id, $upl_img_properties, $upl_img_properties[0], $upl_img_properties[1]);
                                imagegif($target_layer, $folder_path. $file_name_id."_MIN.". $img_ext);
                                break;
                            //for JPEG Image
                            case IMAGETYPE_JPEG:
                                $image_type_id = imagecreatefromjpeg($uploaded_file); 
                                $target_layer = image_resize($image_type_id, $upl_img_properties, $upl_img_properties[0], $upl_img_properties[1]);
                                imagejpeg($target_layer, $folder_path. $file_name_id."_MIN.". $img_ext);
                                break;
                
                            default:
                                echo "Please select a 'PNG', 'GIF'or JPEG image";
                                exit;
                                break;
                
                        }
                
                        //for the record move the uploaded file to the resized image directory
                        $image = $file_name_id ."_MIN.". $img_ext;
                        move_uploaded_file($uploaded_file, $folder_path. "produit_".$file_name_id.".". $img_ext);
                    }
                
                    $nom=filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $id_cat=filter_input(INPUT_POST, 'id_cat', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $prix=filter_input(INPUT_POST, 'prix', FILTER_SANITIZE_NUMBER_INT);
                    $desc=filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $anp = new Produits;
                    $anp->ajouterProduits($image, $nom, $id_cat, $prix, $desc);
                }
            }
        }
        header('Location: /AjoutProduits');
    break;

    // !Page admin! Page du formulaire pour ajouter une nouvelle photo
    case "AjoutPhoto" :
        if ($_SESSION["level"]==1) {
            $listPages = Photo::listPage();
            $page = new FormAjoutPhoto($listPages);
        } else {
            header("location: /");
        }
    break;

    // Traitement du formulaire de telechargement d'une nouvelle photo
    case "AjoutNewPhotos" :
        $accueil=false;
        if (isset($_POST['ajoutPhoto'])) {
            if(is_array($_FILES) AND isset($_POST['id_cat'])) {
                if(!empty($_POST['id_cat'])) {
                    if(is_array($_FILES)) {
                        foreach ($_FILES as $index => $value) {
                            var_dump($value['name']);
                            if ($value['name']=="") {
                                break;
                            }
                            $uploaded_file = $_FILES[$index]['tmp_name'];
                            $upl_img_properties = getimagesize($uploaded_file);
                            $file_name_id=uniqid('', true);
                            $folder_path = "img/bibli/";
                            $img_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                            $image_type = $upl_img_properties[2];
                            switch ($image_type) {
                                //for PNG Image
                                case IMAGETYPE_PNG:
                                    $image_type_id = imagecreatefrompng($uploaded_file); 
                                    $target_layer = image_resize($image_type_id, $upl_img_properties, $upl_img_properties[0], $upl_img_properties[1]);
                                    imagepng($target_layer, $folder_path. $file_name_id. "_MIN.". $img_ext);
                                    break;
                                //for GIF Image
                                case IMAGETYPE_GIF:
                                    $image_type_id = imagecreatefromgif($uploaded_file); 
                                    $target_layer = image_resize($image_type_id, $upl_img_properties, $upl_img_properties[0], $upl_img_properties[1]);
                                    imagegif($target_layer, $folder_path. $file_name_id."_MIN.". $img_ext);
                                    break;
                                //for JPEG Image
                                case IMAGETYPE_JPEG:
                                    $image_type_id = imagecreatefromjpeg($uploaded_file); 
                                    $target_layer = image_resize($image_type_id, $upl_img_properties, $upl_img_properties[0], $upl_img_properties[1]);
                                    imagejpeg($target_layer, $folder_path. $file_name_id."_MIN.". $img_ext);
                                    break;
                                default:
                                    echo "Please select a 'PNG', 'GIF'or JPEG image";
                                    exit;
                                    break;
                            }
                            switch ($index) {
                                case "imaget":
                                    $photo2 = $file_name_id .".". $img_ext;
                                    move_uploaded_file($uploaded_file, $folder_path. "photo_".$file_name_id.".". $img_ext);
                                    break;
                                default :
                                    $photo = $file_name_id .".". $img_ext;
                                    move_uploaded_file($uploaded_file, $folder_path. "photo_".$file_name_id.".". $img_ext);
                                }
                            $descpage=filter_input(INPUT_POST, 'descpage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                            $page=filter_input(INPUT_POST, 'id_cat', FILTER_SANITIZE_NUMBER_INT);
                            if ($page==1) {
                                $accueil=true;
                            } else if (isset($_POST['photopage'])) {
                                $accueil=filter_input(INPUT_POST, 'photopage', FILTER_SANITIZE_NUMBER_INT); 
                            }
                            else  {
                                $accueil=0;
                            }
                        }
                        $anp = new Photo;
                        $anp->ajouterPhoto($photo, $photo2, $descpage, $page, $accueil);
                    }
                }
            }
        }
        header('Location: /AjoutPhoto');
    break;

    // Page d'accueil
    case "Accueil" :
    case "" :
        $listPhoto = Photo::listCarouselAcc();
        $page = new Accueil($listPhoto);
    break;

    // Page balade à dos d'anes
    case "Balade-a-dos-d-ane" :
        $listPhoto = Photo::listCarouselBalade();
        $page = new Balade($listPhoto);
    break;

    // Page location d'ânes bâtés
    case "Location-d-anes-bates" :
        $listPhoto = Photo::listCarouselLoc();
        $page = new Location($listPhoto);
    break;

    // Page vente d'ânes
    case "Vente-d-ane" :
        $listVnt = Photo::listVente();
        $page = new Vente($listVnt);
    break;

    // Traitement en cas de suppression d'un message reçu via le formulaire de contact
    case "DelVente" :
        $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
        $delVnt = new Photo;
        $delVnt->delVente($id);
        header("location: /Vente-d-ane");
    break;

    // Page écopastoralisme
    case "Ecopastoralisme" :
        $listEcp = Photo::listEcoPast();
        $page = new Ecopastoralisme($listEcp);
    break;

    // Page défaut
    default : 
        header('HTTP/1.1 404 Not Found');
        header("Location: /");
        die();
    break;  
}

// fonction lié a la création de miniatures des images lors de la création d'un nouveau produit
function image_resize($image_type_id, $upl_img_properties, $img_width, $img_height) {
    $target_width =150;
    $target_height =150;
    list($img_width, $img_height) = $upl_img_properties;
    $ratio_orig = $img_width/$img_height;
        if ($target_width/$target_height > $ratio_orig) {
            $target_width = $target_height*$ratio_orig;
        } else {
            $target_height = $target_width/$ratio_orig;
        }
    $target_layer= imagecreatetruecolor($target_width, $target_height);
    imagecopyresampled($target_layer, $image_type_id,0,0,0,0, $target_width, $target_height, $img_width, $img_height);
    return $target_layer;
}