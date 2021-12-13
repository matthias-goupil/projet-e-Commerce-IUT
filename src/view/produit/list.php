<main>
    <?php
        if(Session::userIsAdmin()){
            ?>
            <div id="barreAdmin">
                <a href="?controller=produit&action=create" class="button">Ajouter un produit</a>
            </div>
            <?php
        }
    ?>
    <div id="produits">
        <?php
        foreach ($tabProduits as $produit){
            if(Session::userIsAdmin()){?>
                <div class="produitAdmin">
            <?php }
                ?>
            <a href="?controller=produit&action=read&idProduit=<?php echo $produit->get("idproduit")?>"><div class="produit <?php echo (Session::userIsAdmin())?"admin":"";?>">
                    <div class="imageProduit">
                        <img src="<?php echo $produit->get("urlImage1")?>" />
                    </div>
                    <p><?php echo $produit->get("intitule") ?></p>
                    <p>Prix : <?php echo $produit->get("prix")?> €</p>
                    <?php
                        if(Session::userIsAdmin()){
                            ?>

                            <?php
                        }
                    ?>
                </div></a>
                    <?php
                    if(Session::userIsAdmin()){?>
                        <div class="adminButtons">
                            <a href="?controller=produit&action=update&idproduit=<?php echo $produit->get("idproduit")?>">Modifier</a>
                            <a href="?controller=produit&action=deleted&idproduit=<?php echo $produit->get("idproduit")?>">Supprimer</a>
                        </div>
                        </div>
                        <?php }
                        ?>
        <?php } ?>
    </div>

</main>


