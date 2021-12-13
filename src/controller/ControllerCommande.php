<?php

class ControllerCommande {
    private static $objet = "commande";

    public static function readAll(){

    require_once File::build_path(["model","ModelCommande.php"]);

    if(!Session::userIsAdmin()){
        $tabCommandes = ModelCommande::selectAllCommandesByIdUtilisateur(Session::getIdUtilisateur());
        $titre = "Vos Commandes";
    }
    else {
        $tabCommandes = ModelCommande::selectAll();
        $titre = "Toutes les commandes";
    }
        $view = "commandes";
        require File::build_path(["view","view.php"]);
    }


}