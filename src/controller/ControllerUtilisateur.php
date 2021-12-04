<?php
class ControllerUtilisateur {
    private static $objet = "utilisateur";

    public static function connexion(){
        require_once File::build_path(["view", "connexion", "connexion.php"]);
    }

    public static function inscription(){
        $view = "inscription";
        $titre = "Inscription";
        require File::build_path(["view","view.php"]);
    }

    public static function connected(){
        echo 'funni clock man';
    }

    public static function create() {

    }

    public static function profil(){

    }
}