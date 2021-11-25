<?php


class ControllerProduit {
    private static $objet = "produit";

    public static function readAll(){
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);

        $tabProduits = ModelProduit::selectAll();
        $view = "list";
        $titre = "liste des produits";

        require File::build_path(["view","view.php"]);
    }
}