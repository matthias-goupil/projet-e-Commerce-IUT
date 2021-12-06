<?php


class ControllerAvis {
	private static $objet = "avis";

	public static function goToForm($idProduit) {
        require_once File::build_path(["model","ModelUtilisateur.php"]);
        require_once File::build_path(["model","ModelProduit.php"]);
        $produit = ModelProduit::select($_GET['idProduit']);
        $util = ModelAvis::selectUtilisateursByProduit($_GET['idProduit']);

        $controller=''; 
            $view='formAvis';
            $pagetitle='Ecrivez votre commentaire';
            require File::build_path(array("view","view.php"));
}