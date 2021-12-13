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

    public static function commander(){
        if($idUser = Session::getIdUtilisateur()){
            $view = "commander";
            $titre = "Commander le panier";
            require_once File::build_path(["model","ModelContenuPanier.php"]);
            require_once File::build_path(["model","ModelUtilisateur.php"]);
            $user = ModelUtilisateur::select(Session::getIdUtilisateur());
            $tabProduits = ModelContenuPanier::selectAllProduitsPanierByIdUtilisateur($idUser);
            require_once File::build_path(["view","view.php"]);
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function commandePaye(){
        if($idUser = Session::getIdUtilisateur()){
            require_once File::build_path(["model","ModelCommande.php"]);
            require_once File::build_path(["model","ModelPanier.php"]);
            require_once File::build_path(["model","ModelUtilisateur.php"]);
            $user = ModelUtilisateur::select(Session::getIdUtilisateur());
            $user->update([
                "adressePostale" => ($user->get("adressePostale") == "")?$_POST["adresseLivraison"]:$user->get("adressePostale"),
                "ville" => ($user->get("ville") == "")?$_POST["villeLivraison"]:$user->get("ville"),
                "codePostal" => ($user->get("codePostal") == "")?$_POST["codePostalLivraison"]:$user->get("codePostal"),
                "numeroTelephone" => ($user->get("numeroTelephone") == "")?$_POST["numeroTelephone"]:$user->get("numeroTelephone"),
                "idUtilisateur" => Session::getIdUtilisateur()
            ]);
            $date = new DateTime();
            $date->modify("+7 day");

            (new ModelCommande([
                "idUtilisateur" => Session::getIdUtilisateur(),
                "idPanier" => ModelPanier::getIdPanierByUserID(Session::getIdUtilisateur()),
                "nom" => $_POST["nom"],
                "prenom" => $_POST["prenom"],
                "adresseLivraison" => $_POST["adresseLivraison"],
                "villeLivraison" => $_POST["villeLivraison"],
                "codePostalLivraison" => $_POST["codePostalLivraison"],
                "numeroTelephone" => $_POST["numeroTelephone"],
                "dateLivraison" => $date->format("Y-m-d")
            ]))->save();

            self::valider();
        }
    }

    public static function valider(){
        $view = "valider";
        $titre = "Voici votre panier";
        require_once File::build_path(["view","view.php"]);
    }

}
