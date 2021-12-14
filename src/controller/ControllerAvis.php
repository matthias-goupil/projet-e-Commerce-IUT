<?php


class ControllerAvis {
	private static $objet = "avis";

	public static function goToForm() {
	    $idProduit = rawurldecode(($_GET['idProduit']));

        if (Session::userIsCreate()) {
            require_once File::build_path(["model","ModelProduit.php"]);
            require_once File::build_path(["model","ModelUtilisateur.php"]);
            require_once File::build_path(["model","ModelAvis.php"]);

            $produit = ModelProduit::select(rawurldecode($_GET['idProduit']));
            $util = ModelAvis::selectUtilisateursByProduit(rawurldecode($_GET['idProduit']));

            $view = 'formAvis';
            $pagetitle = 'Ecrivez votre commentaire';
            require File::build_path(array("view","view.php"));
        }
        else {
            header("Location: ?controller=produit&action=read&idProduit=".rawurlencode($idProduit));
        }
    }

    public static function create() {
        require_once File::build_path(["model","ModelAvis.php"]);

        $idProduit = rawurldecode($_GET['idProduit']);

        if (Session::userIsCreate() == false) {
             header("Location: ?controller=produit&action=read&idProduit=".rawurlencode($idProduit));
        }
        else if( Session::getIdUtilisateur() == ModelAvis::selectUtilisateursByProduit($idProduit)) {
            header("Location: ?controller=produit&action=read&idProduit=".rawurlencode($idProduit));
        }
        else if(isset($_POST["commentaire"])){ // Deux champs complétés
            $idUtilisateur = Session::getIdUtilisateur();
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

            header("Location: ?controller=produit&action=read&idProduit=".rawurlencode($idProduit));
        }
        else { // Seul champ obligatoire complété
            $note = $_POST["note"];
            $avis = new ModelAvis([  "note" => $note,
                               "idProduit" => $idProduit,
                               "idUtilisateur" => $idUtilisateur
                                ]);
            $avis->save();
            header("Location: ?controller=produit&action=read&idProduit=".rawurlencode($idProduit));
        }
    }
}