<?php


class ControllerPanier {
    private static $objet = "panier";

    public static function readAll(){
        require File::build_path(["model","ModelPanier.php"]);;

        $tab_panier = ModelPanier::selectAll();
        $view = "panier";
        $titre = "Votre panier";

        require File::build_path(["view","view.php"]);
    }
} 