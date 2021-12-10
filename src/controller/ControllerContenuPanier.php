<?php

class ControllerContenuPanier {
    private static $objet = "contenuPanier";

    public static function readAll(){
    require_once File::build_path(["model","ModelContenuPanier.php"]);
    
    	if(Session::userIsCreate()){
	    $tabProduitsPanier = ModelContenuPanier::selectAllProduitsPanierByIdUtilisateur(Session::getIdUtilisateur());
	    $view = "produitsPanier";
	    $titre = "Voici votre panier";

	    require File::build_path(["view","view.php"]);
    	} else {
    	    header("Location: ?controller=produit&action=readAll");
    	}

        
    }

    public static function ajouter(){
        require_once File::build_path(["model","ModelContenuPanier.php"]);

        $data = [
            "idProduit" => $_GET['idProduit'],
            "idUtilisateur" => Session::getIdUtilisateur()

        ];
    
        ModelContenuPanier::ajouterProduit($data);
        header("Location: ?controller=contenuPanier&action=readAll");
    }


    public static function supprimer(){
        require_once File::build_path(["model","ModelContenuPanier.php"]);

        $data = [
            "idProduit" => $_GET['idProduit'],
            "idUtilisateur" => Session::getIdUtilisateur()
        ];
    
        ModelContenuPanier::supprimerProduit($data);
        header("Location: ?controller=contenuPanier&action=readAll");
        

    }

    public static function valider(){
        $view = "valider";
        $titre = "Voici votre panier";
        require_once File::build_path(["view","view.php"]);
    }
}
