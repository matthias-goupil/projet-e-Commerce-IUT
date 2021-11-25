<?php

class ControllerProduit {
    private static $objet = "produit";

    public static function readAll(){
        require File::build_path(["model","ModelProduit.php"]);
        require File::build_path(["model","ModelImagesProduit.php"]);

        $tabProduits = ModelProduit::selectAll();
        $view = "list";
        $titre = "liste des produits";

        require File::build_path(["view","view.php"]);
    }

    public static function read(){
        require File::build_path(["model","ModelAvis.php"]);
        require File::build_path(["model","ModelProduit.php"]);

        $produit = ModelProduit::select($_GET['idProduit']);
        $util = ModelAvis::selectUtilisateursByProduit($_GET['idProduit']);
        
        /*if($produit== NULL) {
            $controller=''; 
            $view='error';
            $pagetitle='Erreur'; 
            require File::build_path(array("view","view.php"));
        }
        else {*/

            $controller=''; 
            $view='detail';
            $pagetitle='Détail du produit';
            require File::build_path(array("view","view.php"));   
        //}
    }
}