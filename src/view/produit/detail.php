<?php

    $intitule = htmlspecialchars($produit->get("intitule"));
    $prix = rawurlencode($produit->get("prix"));
    $description = htmlspecialchars($produit->get("description"));
    $quantite = htmlspecialchars($produit->get("quantite"));
    $nbVue = htmlspecialchars($produit->get("nbVue"));
    $scam = htmlspecialchars($produit->get("quantite") + 3 );
    $noteAddition = 0;
    $nbAvis = 0;

   
    echo '<p> ' . $intitule . ' </p>'; //TITRE PRODUIT

    for($i = 1; $i<6; $i++) { //IMAGES PRODUIT
        $num = "urlImage".''. $i;
        echo "<img src=\"".$produit->get($num) ."\" />";
    }

    echo '<p> Prix : ' . $prix . ' €</p>'; //PRIX 
    echo '<p> ' . $quantite . ' produit(s) restant(s), payez !</p>'; //QUANTITE
    echo '<p> ' . $scam . ' personnes consultent actuellement la page </p>'; // QUANTITE + 3
    echo '<p> Description : ' . $description . '.</p>'; //DESCRIPTION

    
    foreach($util as $avis) {
        $noteAddition += $avis["avis"]->get("note");
            $nbAvis++;
    }
    if($nbAvis > 0) {
        $noteGlobale = $noteAddition / $nbAvis;
        echo '<p> Note moyenne : ' . $noteGlobale . '</p>'; // NOTE MOYENNE
    }

    foreach($util as $avis) {
            $nP = $avis["utilisateur"]->get("nom") .' '. $avis["utilisateur"]->get("prenom"); // NOM PRENOM AVIS
            echo '<p>' . $nP .  ' : </p>';
            echo '<p> Note : ' . $avis["avis"]->get("note") . ' </p>'; // NOTE AVIS
            if($avis["avis"]->get("commentaire") != null ) {
                echo '<p> Commentaire : ' . $avis["avis"]->get("commentaire") . '.</p>'; // COMMENTAIRE AVIS
            }

    

    }

    //echo '<a href="./index.php?action=update&idProduit=' . $idProduit . '">Modifier</a>';

    //echo '<a href="./index.php?action=delete&idProduit=' . $idProduit . '">Supprimer</a>';
?>