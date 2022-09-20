<?php

class VuePanier {

    private string $titre='Panier';
    private Array $liste;

    public function getTitre(){
        echo $this->titre;
    }

    public function __construct(Array $liste) {
        $this->liste = $liste;
    }

    public function html()
    {
        echo '
        <h3>Votre panier : </h3>';
        if (!($_SESSION['panier'])) {
            echo '
            <div class="panier_vide">
                <p>Votre panier est vide pour le moment</p>
                <a class="button" href="/Boutique">Visitez notre boutique</a>
            </div>';
        } else {
            echo'
            <div class="c_panier">
                <div>
                    <div></div>
                </div>
                <div>
                    <div></div>
                </div>
                <div>
                    <div><p>Quantité</p></div>
                </div>
                <div>
                    <div><p>Prix HT</p></div>
                </div>
                <div>
                    <div><p>Prix TTC</p></div>
                </div>';
                $total = 0;
                foreach($this->liste as $product) {
                echo '
                <div>
                    <div class="img_panier"><img src="img/produits/'.$product->getImage().'"></div>
                </div>
                <div>    
                    <div>
                        <h4>'.$product->getNom().'<h4>
                        <p class="desc_prod_pan">'.$product->getDesc().'</p>
                        <a class="delbout" href="DeletePanier?del='.$product->getID().'" rel="'.$product->getID().'"><span class="sup_produit">Supprimer ce produit du panier</span></a>
                    </div>
                </div>
                <div>
                    <div class="p_quant">
                        <div><a title="baisser la quantité" class="moinspan" href="EnleverPanier?id='.$product->getID().'" rel="'.$product->getID().'"><i class="fa fa-square-minus" aria-hidden="true"></i></a></div>
                        <div class="prix_art_pan">'.$_SESSION['panier'][$product->getID()].'</div>
                        <div><a title="augmenter la quantité" class="pluspan" href="AjoutPanier?idp='.$product->getID().'" rel="'.$product->getID().'"><i class="fa fa-square-plus" aria-hidden="true"></i></a></div>
                    </div>
                </div>
                <div>
                    <div class="prix">'.number_format(($product->getPrix() * $_SESSION['panier'][$product->getID()]) / 1.196,2,',', ' ').' €</div>
                </div>
                <div>
                    <div class="prix">'.number_format($product->getPrix() * $_SESSION['panier'][$product->getID()],2,',', ' ').' €</div>
                </div>';
            
                $total += ($product->getPrix() * $_SESSION['panier'][$product->getID()]);
                };

                echo '
                <div>
                    <div>Total HT : '.number_format($total / 1.196,2,',', ' ').' €</div>
                </div>
                <div>
                    <div>Total TTC : '.number_format($total,2,',', ' ').' €</div>
                </div>
            </div>
            <div class="panier_valid">';
            if (isset($_SESSION["id_cli"])) {
                echo '
                <form method="post" action="Panier-valid">
                    <input type="hidden" id="total" name="total" value="'.$total.'">';
                    $sPanier = serialize($_SESSION['panier']);
                    $id_cli = $_SESSION["id_cli"];
                    echo '
                    <input type="hidden" id="sPanier" name="sPanier" value="'.$sPanier.'">
                    <input type="hidden" id="id_cli" name="id_cli" value="'.$id_cli.'">
                    <input type="submit" name="validPanier" value="Passer la commande">
                </form>';
            } else { 
                echo '<p>Vous devez être connecté pour valider le panier.</p>
                <a class="button" href="/Connexion">Connexion</a>
                <a class="button" href="/Inscription">Inscription</a>';
            };
            echo '</div>';
        }
    }
}
