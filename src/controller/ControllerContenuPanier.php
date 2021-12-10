<?php

class ControllerContenuPanier {
    private static $objet = "contenuPanier";

    public static function readAll(){

        if(Session::userIsCreate()){
            require_once File::build_path(["model","ModelContenuPanier.php"]);
            $tabProduitsPanier = ModelContenuPanier::selectAllProduitsPanierByIdUtilisateur(Session::getIdUtilisateur());
        }
        else{
            if(!Session::cartIsCreate()){
                Session::createCart();
            }
            require_once File::build_path(["model","ModelProduit.php"]);

            Session::insertProduitIntoKart(ModelProduit::select(6),2);
            $tabProduitsPanier = Session::getKart();
        }
        $view = "produitsPanier";
        $titre = "Voici votre panier";
	      require File::build_path(["view","view.php"]);
    }

    public static function ajouter(){
        if(Session::userIsCreate()){
            require_once File::build_path(["model","ModelContenuPanier.php"]);
            $data = [
                "idProduit" => $_GET['idProduit'],
                "idUtilisateur" => Session::getIdUtilisateur()
            ];
            ModelContenuPanier::ajouterProduit($data);
        }
        else{
            Session::incrementQuantiteProduitInCart($_GET["idProduit"]);
        }

        header("Location: ?controller=contenuPanier&action=readAll");
    }


    public static function supprimer(){
        if(Session::userIsCreate()){
            require_once File::build_path(["model","ModelContenuPanier.php"]);

            $data = [
                "idProduit" => $_GET['idProduit'],
                "idUtilisateur" => Session::getIdUtilisateur()
            ];
            ModelContenuPanier::supprimerProduit($data);
        }
        else{
            Session::decrementQuantiteProduitInCart($_GET["idProduit"]);
        }
        header("Location: ?controller=contenuPanier&action=readAll");
    }

    public static function valider(){
        $view = "valider";
        $titre = "Voici votre panier";
        require_once File::build_path(["view","view.php"]);
    }
}
