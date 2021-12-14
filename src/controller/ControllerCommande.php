<?php

class ControllerCommande {
    private static $objet = "commande";

    public static function readAll(){
        require_once File::build_path(["model","ModelCommande.php"]);

        if(Session::userIsCreate()){
            if(!Session::userIsAdmin()){
                $tabCommandes = ModelCommande::selectAllCommandesByIdUtilisateur(Session::getIdUtilisateur());
                $titre = "Vos Commandes";
            }
            else {
                $tabCommandes = ModelCommande::selectAll();
                $titre = "Toutes les commandes";
            }
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
        $view = "commandes";
        require File::build_path(["view","view.php"]);
    }
}