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
            "idProduit" => $_GET['idProduit']
        ];
    
        ModelProduitsPanier::ajouterProduit($data); 
        ControllerProduitsPanier::readAll();
       
        
    }


    public static function supprimer(){
        require_once File::build_path(["model","ModelProduitsPanier.php"]);

        $data = [
            "idProduit" => $_GET['idProduit']
        ];
    
        ModelProduitsPanier::supprimerProduit($data);
        ControllerProduitsPanier::readAll();
    }

    public static function valider(){
        $view = "valider";
        $titre = "Voici votre panier";
        require_once File::build_path(["view","view.php"]);
    }
}