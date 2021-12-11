<?php
class ControllerConnexion {
    protected static $object = "connexion";

    public static function read() {
        if (empty($_SESSION["user"])) {
            $view = "connexion";
            $title = "connexion";
            require File::build_path(["view", "view.php"]);
        } else {
            header("Location: ?controller=accueil");
        }
    }
}


