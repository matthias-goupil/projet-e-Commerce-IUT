<main>
    <?php
        foreach ($tabProduits as $produit){ ?>
            <div class="produit">
                <div class="imageProduit">
                    <img src="<?php echo $produit->get("urlImage1")?>" />
                </div>
                <a href="?controller=produit&action=read&idProduit=<?php echo $produit->get("idProduit")?>"> <?php echo $produit->get("intitule") ?> </a>
                <p>Prix : <?php echo $produit->get("prix")?> €</p>
            </div>
        <?php } ?>
</main>


