<main>
    <form method="POST" action="?controller=contenuPanier&action=commandePaye">
        <h2><?php echo htmlspecialchars($titre)?></h2>
        <div id="prenomNom">
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom" placeholder="Prénom" value="<?php echo htmlspecialchars($user->get("prenom"))?>" required>
            </div>
            <div>
                <label>Nom</label>
                <input type="text" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($user->get("nom"))?>" required>
            </div>
        </div>
        <?php
        if(isset($errorNomPrenom)){
            ?><p class="error"><?php echo htmlspecialchars($errorNomPrenom)?></p><?php
        }
        ?>

        <div>
            <label>Adresse de livraison</label>
            <input type="text" name="adresseLivraison" value="<?php echo htmlspecialchars($user->get("adressePostale"))?>">
        </div>

        <div>
            <label>Ville de livraison</label>
            <input type="text" name="villeLivraison" value="<?php echo htmlspecialchars($user->get("ville"))?>">
        </div>

        <div>
            <label>Code postal de livraison</label>
            <input type="text" name="codePostalLivraison" value="<?php echo htmlspecialchars($user->get("codePostal"))?>">
        </div>

        <div>
            <label>Numéro de téléphone</label>
            <input type="text" name="numeroTelephone" value="<?php echo htmlspecialchars($user->get("numeroTelephone"))?>">
        </div>

        <input type="submit" value="Commander">
    </form>

    <div id="panier">
        <div id="produits">
            <h2>Panier</h2>
                    <?php
                        $prixTotal = 0;
                        foreach ($tabProduits as $produit){
                            $prixTotal += $produit["produit"]->get("prix")*$produit["contenuPanier"]->get("quantite");
                            ?>
                            <a href="?controller=produit&action=read&idProduit=<?php echo $produit["produit"]->get("idproduit")?>" class="produit">
                                <div>
                                    <img src="<?php echo htmlspecialchars($produit["produit"]->get("urlImage1"))?>">
                                    <p><?php echo htmlspecialchars($produit["produit"]->get("intitule"))?></p>
                                </div>
                                <p>Quantité : <?php echo htmlspecialchars($produit["contenuPanier"]->get("quantite"))?></p>
                            </a>
                            <?php
                        }
                    ?>
        </div>
        <p id="prix">
            Prix Total : <?php echo htmlspecialchars($prixTotal)?> €
        </p>
    </div>

</main>