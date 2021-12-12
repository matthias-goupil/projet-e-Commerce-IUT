<main>
    <?php
        if(Session::userIsAdmin()){
            ?>
            <div id="barreAdmin">
                <a href="#" class="button">Ajouter un produit</a>
                <a href="#" class="button">Commandes en cours</a>
                <a href="#" class="button">Historique commandes</a>
            </div>
            <?php
        }
    ?>
    <div class="produits">
        <?php
        foreach ($tabProduits as $produit){ ?>
            <a href="?controller=produit&action=read&idProduit=<?php echo $produit->get("idproduit")?>"><div class="produit">
                    <div class="imageProduit">
                        <img src="<?php echo $produit->get("urlImage1")?>" />
                    </div>
                    <p><?php echo $produit->get("intitule") ?></p>
                    <p>Prix : <?php echo $produit->get("prix")?> €</p>
                </div></a>
        <?php } ?>
    </div>

</main>


