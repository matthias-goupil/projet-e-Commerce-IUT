<?php
foreach ($tabProduits as $produit){
    $images = ModelImagesProduit::select($produit->get("idImagesProduit"));
    echo "<h2>".$produit->get("intitule")."</h2>";
    echo "<img src=\"".$images->get("urlImage1")."\" />";
}