<?php
require_once File::build_path(["controller","ControllerError.php"]);
require_once File::build_path(["controller","ControllerProduit.php"]);
require_once File::build_path(["controller","ControllerContenuPanier.php"]);
require_once File::build_path(["controller","ControllerUtilisateur.php"]);
require_once File::build_path(["controller","ControllerAvis.php"]);
require_once File::build_path(["controller","ControllerCommande.php"]);


if((!isset($_GET["controller"]) && !isset($_GET["action"])) || (!isset($_GET["controller"]))) { // si le controller et l'action n'existent pas
    $controller = "ControllerProduit";
    $action = "readAll";
}
else if(!isset($_GET["action"])){ // si saul l'action n'existe pas
    $controller = "Controller".ucfirst($_GET["controller"]);
    $action = "readAll";
}
else{ // si les deux existent
    $controller = "Controller".ucfirst($_GET["controller"]);
    $action = $_GET["action"];
}

if(!class_exists($controller) || !method_exists($controller,$action)){
    $controller = "ControllerError";
    $action = "pageNonTrouvee";
}

$controller::$action();


