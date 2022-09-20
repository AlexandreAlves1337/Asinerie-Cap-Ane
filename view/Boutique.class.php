<?php
// Cette classe permet de construire le formulaire de création d'un nouveau thème
// This class allows you to build the form to create a new theme
class Boutique {

    private string $titre='Boutique';
    private Array $liste;
    private Array $liste2;
    private Array $liste3;
    private string $cat_nom='';

    public function __construct(Array $liste, Array $liste2, Array $liste3, string $cat_nom) {
       $this->liste = $liste;
       $this->liste2 = $liste2;
       $this->liste3 = $liste3;
       $this->cat_nom = $cat_nom;
    }

    public function getTitre(){
        echo $this->titre;
    }

    public function html()
    {
        echo '
        <div class="accueil">
            <div class="texte">
                <p>Je m\'appelle Valérie Lapendrie et je vous souhaite la bienvenue sur ma boutique en ligne. Je suis éleveuse d\'ânes des Pyrénées et surtout passionnée par ce métier.</p>
                <p>Je produis une gamme de cosmétiques concentrés en lait d’ânesse possédant de nombreuses vertus en particulier hautement hydratantes, apaisantes pour des affections telles que l\'eczéma ou le psoriasis, et même antirides et anti oxydantes.</p>
                <p>Je récolte le lait de mes ânesses dans le respect de l\'animal en assurant son bien-être et sa santé.</p>
                <p>Le lait est transformé par un laboratoire artisanal et familial proche de mon exploitation avec lequel nous n’utilisons que des produits locaux de haute qualité, naturels et toujours traçables ce qui nous permet de garantir des propriétés totalement hypoallergénique.</p>
            </div>
        </div>
        <div class="two-column">
            <section class="element-flexible fs1">
                <h3>Nos produits '.$this->cat_nom.' : </h3>
                <div>';
                foreach($this->liste as $produit) {
                    echo '
                    <div class="c_produit">
                        <div class="img_produit">
                            <img src="img/produits/'.$produit->getImage().'">
                        </div>
                        <div class="desc_produit">
                            <h4>'.$produit->getNom().'<h4>
                            <h5>'.$produit->getCatNom().'</h5>
                            <p>'.$produit->getDesc().'</p>
                        </div>
                        <div class="prix_boutique">
                            <div>'.$produit->getPrix().' €</div>
                            <div><a class="subbout button" href="AjoutPanier?idb='.$produit->getID().'" rel="'.$produit->getID().'"><i class="fa fa-cart-plus" aria-hidden="true">&nbsp;</i><span class="text_panier">Ajoutez au panier</span></a></div>';
                            if (isset($_SESSION["level"]) AND $_SESSION["level"]==1) {
                                echo '
                                <div><a class="disabled" href="DesactivProd?id='.$produit->getID().'"><i title="Désactivez ce produit" class="disabled fa-solid fa-rectangle-xmark"></i></a></div>';
                                };
                        echo '
                        </div>
                    </div>';
                };
                echo '
                </div>
            </section>
            <aside id="panbou" class="element-flexible ef60 fs0">';
            if ($this->liste3) {
                $total=0;
            echo '
            <div class="panbou">
            <h3>Panier : </h3>
                <div class="pan_bou">';
                foreach($this->liste3 as $product) {
                    if (strlen($product->getNom())>30) {
                        $nomproduit = substr($product->getNom(),0,30)."...";
                    } else {
                        $nomproduit = $product->getNom();
                    }
                    echo '
                    <div>
                        <div>'.$nomproduit.'</div>
                        <div>'.$_SESSION['panier'][$product->getID()].'</div>
                        <div>'.number_format($product->getPrix() * $_SESSION['panier'][$product->getID()],2,',', ' ').' €</div>
                    </div>';
                        $total += ($product->getPrix() * $_SESSION['panier'][$product->getID()]);
                };
                echo '<div><div>Total : '.number_format($total,2,',', ' ').' €</div></div>
                </div>
                <a class="button" href="Panier">Voir le panier</a>

            </div>';
        }

            echo '
            <div><h3>Filtre : </h3>
            <ul class="list_cat_prod">
                <li><a href="Boutique">Tous les produits</a></li>
                <li>
                    <ul>';
                    foreach($this->liste2 as $categorie) {
                    echo '
                        <li><a href="Boutique?cat='.$categorie->getID().'_'.$categorie->getCatNom().'">'.$categorie->getCatNom().'</a></li>';
                    };
                    echo '
                    </ul>
                </li>
            </ul>
            </div>
        </aside>
        </div>';
    }
}