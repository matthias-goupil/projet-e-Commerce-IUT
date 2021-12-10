<?php

class ControllerProduitsPanier {
    private static $objet = "produitsPanier";

    public static function readAll(){
    require_once File::build_path(["model","ModelProduitsPanier.php"]);

        $tabProduitsPanier = ModelProduitsPanier::selectAllProduitsPanier();
        $view = "produitsPanier";
        $titre = "Voici votre panier";

        require File::build_path(["view","view.php"]);
    }
}