<main>
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
</main>


