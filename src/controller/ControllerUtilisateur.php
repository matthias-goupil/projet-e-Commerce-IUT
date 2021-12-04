<?php

class ControllerUtilisateur {
    private static $objet = "utilisateur";

    public static function connexion(){

    }

    public static function inscription(){
        $view = "inscription";
        $titre = "Inscription";
        require File::build_path(["view","view.php"]);
    }

    public static function connected(){

    }

    public static function create(){

    }

    public static function profil(){

    }
}