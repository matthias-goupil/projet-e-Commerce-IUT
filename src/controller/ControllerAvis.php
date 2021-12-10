<?php


class ControllerAvis {

	private static $objet = "avis";

    
	public static function goToForm() {

        require_once File::build_path(["model","ModelProduit.php"]);

        $idProduit = $_GET['idProduit'];

        if (Session::userIsCreate() == false) {
            header("Location: ?controller=produit&action=read&idProduit=$idProduit");
        }

        else {
            require_once File::build_path(["model","ModelUtilisateur.php"]);
            require_once File::build_path(["model","ModelAvis.php"]);
            $produit = ModelProduit::select($_GET['idProduit']);
            $util = ModelAvis::selectUtilisateursByProduit($_GET['idProduit']);

            $controller=''; 
            $view='formAvis';
            $pagetitle='Ecrivez votre commentaire';
            require File::build_path(array("view","view.php"));
        }
    }

    public static function create() {

        $idUtilisateur = Session::getIdUtilisateur();
        $idProduit = $_GET['idProduit'];
        require_once File::build_path(["model","ModelAvis.php"]);

        if (Session::userIsCreate() == false) {
             header("Location: ?controller=produit&action=read&idProduit=$idProduit");
        }

        else if( Session::getIdUtilisateur() == ModelAvis::selectUtilisateursByProduit($idProduit)) {
            header("Location: ?controller=produit&action=read&idProduit=$idProduit");
        }

        else if(isset($_POST["commentaire"])){ // Deux champs complétés
            $note = $_POST["note"];
            $commentaire = $_POST["commentaire"];
            $anonyme = $_POST["anonyme"] == "on";

            $avis = new ModelAvis(["note" => $note,
                               "commentaire" => $commentaire,
                               "idProduit" => $idProduit,
                               "idUtilisateur" => $idUtilisateur,
                               "anonyme" => $anonyme
                                ]);
            $avis->save();
            header("Location: ?controller=produit&action=read&idProduit=$idProduit");
        }

        else { // Seul champ obligatoire complété
             $note = $_POST["note"];

            $avis = new ModelAvis([  "note" => $note,
                               "idProduit" => $idProduit,
                               "idUtilisateur" => $idUtilisateur
                                ]);
            $avis->save();
            header("Location: ?controller=produit&action=read&idProduit=$idProduit");
        }

    }
}