<?php

class ControllerCommande {
    private static $objet = "commande";

    public static function readAll(){
        
    require_once File::build_path(["model","ModelCommande.php"]);

        $tabCommandes = ModelCommande::selectAll();
        $view = "commandes";
        $titre = "Toutes les commandes";

        require File::build_path(["view","view.php"]);
    }
}