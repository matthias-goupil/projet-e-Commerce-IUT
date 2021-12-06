<div class="detailProduit">
<?php

    $intitule = htmlspecialchars($produit->get("intitule"));
    $prix = rawurlencode($produit->get("prix"));
    $description = htmlspecialchars($produit->get("description"));
    $stock = htmlspecialchars($produit->get("stock"));
    $nbVue = htmlspecialchars($produit->get("nbVue"));
    $scam = htmlspecialchars($produit->get("stock") + 3 );
    $noteAddition = 0;
    $nbAvis = 0;
    $id = $produit->get("idproduit");

    

    ?>
    <div class="images">
    <?php
    
        echo "<img class='image' src=\"".$produit->get("urlImage1") ."\" />";
    
    ?>
    </div>
    <div class ="contenu">
    <?php
    echo '<p class = titre> ' . $intitule . ' </p>'; //TITRE PRODUIT

      foreach($util as $avis) {
        $noteAddition += $avis["avis"]->get("note");
            $nbAvis++;
    }
    $noteReste = 5;

    if($nbAvis > 0) {
        $noteGlobale = $noteAddition / $nbAvis;
        while($noteGlobale != 0) {
            if($noteGlobale >= 1) {
                echo "<span class='etoile_jaune'> ★ </span>";
                $noteGlobale-=1;
            }
            else {
                echo "<span class='etoile_grise'> </span>";
                break;    
            }
        }
        echo '<br>';

    }

    echo '<p class="prix"> Prix :<span class= "chiffrePrix">  ' . $prix . ' €</span></p>'; //PRIX 
    echo '<p class="stock"> ' . $stock . ' produit(s) restant(s), payez !</p>'; //STOCK
    echo '<p class="description"> Description : ' . $description . '.</p>'; //DESCRIPTION
    echo '<p class="scam"> ' . $scam . ' personnes consultent actuellement la page </p>'; // STOCK + 3

    ?>

    <a href="?controller=avis&action=goToForm&idProduit=<?php echo $id; ?>"><button> Ecrire un commentaire </button></a>

    <div class="avis_tout"> Commentaires :
    <?php

    foreach($util as $avis) {
            ?>
            <div class="avis">
            <?php
            $nP = $avis["utilisateur"]->get("nom") .' '. $avis["utilisateur"]->get("prenom"); // NOM PRENOM AVIS
            echo '<p class="nom_prenom">' . $nP .  ' : </p>';
            echo '<p class="note"> Note : ' . $avis["avis"]->get("note") . ' </p>'; // NOTE AVIS
            if($avis["avis"]->get("commentaire") != null ) {
                echo '<p class="commentaire"> Commentaire : ' . $avis["avis"]->get("commentaire") . '.</p>'; // COMMENTAIRE AVIS
            }
            ?>
            </div>
            <?php
    }
    ?>
    </div>
    </div>
    <?php

    //echo '<a href="./index.php?action=update&idProduit=' . $idProduit . '">Modifier</a>';

    //echo '<a href="./index.php?action=delete&idProduit=' . $idProduit . '">Supprimer</a>';
?>
</div>