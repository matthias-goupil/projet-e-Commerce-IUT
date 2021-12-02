<?php
class ControllerConnexion {
    protected static $objet = "utilisateur";

    public static function read() {
        if (empty($_SESSION["user"])) {
            $view = "utilisateur";
            $title = "utilisateur";
            require File::build_path(["view", "view.php"]);
        } else {
            header("Location: ?controller=accueil");
        }
    }
}


