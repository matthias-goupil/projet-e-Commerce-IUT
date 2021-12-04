<main>
    <h1>Votre panier</h1>
    <?php
        $prixTotal = 0;
        foreach ($tabProduitsPanier as $p) {
            echo '
                    <div class ="produitsPanier">
                        <a href="#"><img src="'.htmlspecialchars($p['produit']->get('urlImage1')).'"></a>
                        <a href="#"><p class="nomProduit">'. htmlspecialchars($p['produit']->get('intitule')).'</p></a>
                        
                        <p class="controls"> Quantite :<a href="?controller=produitsPanier&action=ajouter&idProduit='.htmlspecialchars($p['produitsPanier']->get('idProduit')).'" class="ajouter">+</a>  '. htmlspecialchars($p['produitsPanier']->get('quantite')).'  
                        <a href="?controller=produitsPanier&action=supprimer&idProduit='.htmlspecialchars($p['produitsPanier']->get('idProduit')).'" class="supprimer">-</a></p>
                        
                        <p class="prix"> Prix total : '. htmlspecialchars(($p['produit']->get('prix'))*$p['produitsPanier']->get('quantite')).'€</p>
                    </div>
                    <span class "separateur"></span>';

                    $prixTotal += $p['produit']->get('prix')*$p['produitsPanier']->get('quantite');
        }
    ?>

    <div class="total">
        <p>Livré par Mondial Reley</p>
        <p>Frais de livraison : 4.99€</p>
        <p>Total : <?php echo $prixTotal ;?>€</p>
        <a href="#">VALIDER MON PANIER</a>
    </div>
</main>
