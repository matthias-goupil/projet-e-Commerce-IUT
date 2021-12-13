<?php

class ControllerContenuPanier {
    private static $objet = "contenuPanier";

    public static function readAll(){

        if(Session::userIsAdmin() || isset($_GET["idPanier"])) {
            require_once File::build_path(["model","ModelContenuPanier.php"]);
            $tabProduitsPanier = ModelContenuPanier::selectAllProduitPanierByIdPanier($_GET["idPanier"]);
        }
        
        else if(Session::userIsCreate()){
            require_once File::build_path(["model","ModelContenuPanier.php"]);
            $tabProduitsPanier = ModelContenuPanier::selectAllProduitsPanierByIdUtilisateur(Session::getIdUtilisateur());
        }

        else{
            if(!Session::cartIsCreate()){
                Session::createCart();
            }
            require_once File::build_path(["model","ModelProduit.php"]);

            $tabProduitsPanier = Session::getCart();
        }
        $view = "produitsPanier";
        $titre = "Voici votre panier";
	      require File::build_path(["view","view.php"]);
    }

    public static function ajouter(){
        if(Session::userIsCreate()){
            require_once File::build_path(["model","ModelContenuPanier.php"]);

            if(ModelContenuPanier::produitExists($_GET["idProduit"],Session::getIdUtilisateur())){
                $data = [
                    "idProduit" => $_GET['idProduit'],
                    "idUtilisateur" => Session::getIdUtilisateur(),
                    "quantite" => 1
                ];
                ModelContenuPanier::ajouterProduit($data);
            }
            else{
                require_once File::build_path(["model","ModelUtilisateur.php"]);
                $data = [
                    "idProduit" => $_GET['idProduit'],
                    "quantite" => 1,
                    "idPanier" => ModelUtilisateur::selectIdPanier(Session::getIdUtilisateur())
                ];
                (new ModelContenuPanier($data))->save();
            }

        }
        else{
            Session::insertProduitIntoKart($_GET["idProduit"],1);
        }

        header("Location: ?controller=contenuPanier&action=readAll");
    }

    public static function supprimer(){
        if(Session::userIsCreate()){
            require_once File::build_path(["model","ModelContenuPanier.php"]);

            $data = [
                "idProduit" => $_GET['idProduit'],
                "idUtilisateur" => Session::getIdUtilisateur(),
                "quantite" => 1
            ];
            ModelContenuPanier::supprimerProduit($data);
        }
        else{
            Session::decrementQuantiteProduitInCart($_GET["idProduit"],1);
        }
        header("Location: ?controller=contenuPanier&action=readAll");
    }

    public static function valider(){
        $view = "valider";
        $titre = "Voici votre panier";
        require_once File::build_path(["view","view.php"]);
    }
}
