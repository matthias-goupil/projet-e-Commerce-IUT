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

    
 
        echo "<img class='image' src=\"".$produit->get("urlImage1") ."\" />";
    ?>
    <div class ="contenu">
    <?php

    echo '<p class = titre> ' . $intitule . ' </p>'; //TITRE PRODUIT
    
      foreach($util as $avis) {
        $noteAddition += $avis["avis"]->get("note");
            $nbAvis++;
        }
    $noteReste = 5;



    
    echo '<p class="prix"> Prix :<span class= "chiffrePrix">  ' . $prix . ' €</span></p>'; //PRIX 
    echo '<p class="stock"> ' . $stock . ' produit(s) restant(s)</p>'; //STOCK
    echo '<p class="description"> Description : ' . $description . '.</p>'; //DESCRIPTION
    echo '<p class="scam"> ' . $scam . ' personnes consultent actuellement la page </p>'; // STOCK + 3

    ?>

    <div><a href="#"><button class="bouton"> Ajouter au panier </button></a></div>

    <?php

    if (Session::userIsCreate() == true) {
        ?> <div class = bouton_com ><a href="?controller=avis&action=goToForm&idProduit=<?php echo $id; ?>"><button class="bouton"> Ecrire un commentaire </button></a></div> <?php
    } ?>






    <div class="avis_tout"> <h2>Commentaires :</h2>

    <?php

     if($nbAvis > 0) {
        
        $noteGlobale = $noteAddition / $nbAvis;
        $noteGlobale = round($noteGlobale, 1, PHP_ROUND_HALF_UP);
        echo '<p class="note_moy"> Note moyenne : ' . $noteGlobale . '/5</p>';
       }

    else {
        echo '<p class="note_moy"> Personne n\'a encore posté d\'avis sur ce produit </p>';
    }

    foreach($util as $avis) {
            ?>
            <div class="avis">
            <?php

            if($avis["avis"]->get("anonyme")) {
                $nP = 'Utilisateur anonyme';
            }
            else {
                $nP = $avis["utilisateur"]->get("nom") .' '. $avis["utilisateur"]->get("prenom"); // NOM PRENOM AVIS
            }
            echo '<h3 class="nom_prenom">' . $nP .  ' : </h3>';
            echo '<p class="note"> Note : ' . $avis["avis"]->get("note") . ' </p>'; // NOTE AVIS
            if($avis["avis"]->get("commentaire") != null ) {
                echo '<p class="commentaire"> Commentaire : ' . $avis["avis"]->get("commentaire") . '</p>'; // COMMENTAIRE AVIS
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