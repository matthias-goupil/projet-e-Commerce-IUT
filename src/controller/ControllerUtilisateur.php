<?php
class ControllerUtilisateur {
    protected static $objet = "utilisateur";

    public static function connexion(){
        $view = "connexion";
        $titre = "Connexion";
        require File::build_path(["view","view.php"]);    }

    public static function inscription(){

    }

    public static function connected() {
    }

    public static function create() {

    }

    public static function profil(){

    }
}