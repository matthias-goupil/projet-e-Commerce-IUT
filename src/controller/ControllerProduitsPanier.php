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

    public static function ajouter(){
        require_once File::build_path(["model","ModelProduitsPanier.php"]);

        $data = [
            "quantite" => $_GET['quantite']+1,
        ];
    
            $tabProduitsPanier = ModelProduitsPanier::update($data);
            $view = "produitsPanier";
            $titre = "Voici votre panier";
    
            require File::build_path(["view","view.php"]);
            ControllerProduitsPanier::readAll();
    }
}