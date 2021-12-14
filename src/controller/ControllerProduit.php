<?php

class ControllerProduit {
    private static $objet = "produit";

    public static function readAll(){
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);

        $tabProduits = ModelProduit::selectAll();
        $view = "list";
        $titre = "Liste des produits";

        require File::build_path(["view","view.php"]);
    }

    public static function read(){
        require File::build_path(["model","ModelAvis.php"]);
        require File::build_path(["model","ModelProduit.php"]);

        $produit = ModelProduit::select(rawurldecode($_GET['idProduit']));
        $util = ModelAvis::selectUtilisateursByProduit(rawurldecode($_GET['idProduit']));

        $controller=''; 
        $view='detail';
        $titre='Détail du produit';

        require File::build_path(array("view","view.php"));   
    }


    public static function created() {
        if(Session::userIsAdmin()){
            require_once File::build_path(["model","ModelProduit.php"]);
            require_once File::build_path(["model","ModelImagesProduit.php"]);

            $p = new ModelProduit(array(
                "intitule" => $_POST['intitule'],
                "prix" => $_POST['prix'],
                "stock" => $_POST['stock'],
                "description" => $_POST['description'],
                "urlImage1" => $_POST['urlImage1']));
            $p->save();

        }
        header('Location: ?controller=Produit&action=readAll');
    }

    public static function create(){
        if(Session::userIsAdmin()){
            $view = "create";
            $titre ="Gestion Produits";

            require_once File::build_path(array("view", "view.php"));
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function update() {
        if(Session::userIsAdmin()){
            require_once File::build_path(["model","ModelProduit.php"]);
            require_once File::build_path(["model","ModelImagesProduit.php"]);

            $view = "create";
            $titre ="Gestion Produits";
            $p = ModelProduit::select(rawurldecode($_GET['idproduit']));

            require_once File::build_path(array("view", "view.php"));
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function updated(){
        if(Session::userIsAdmin()){
            require_once File::build_path(["model","ModelProduit.php"]);
            require_once File::build_path(["model","ModelImagesProduit.php"]);

            $idproduit = rawurldecode($_GET['idproduit']);
            $data = array(
                'idproduit' => $idproduit,
                'intitule' => $_POST['intitule'],
                'prix' => $_POST['prix'],
                'stock' => $_POST['stock'],
                'description' => $_POST['description'],
                'urlImage1' => $_POST['urlImage1']
            );
            ModelProduit::update($data);
        }
        header("Location: ?controller=produit&action=readAll");
    }

    public static function deleted() {
        if(Session::userIsAdmin()){
            require_once File::build_path(["model","ModelProduit.php"]);
            require_once File::build_path(["model","ModelImagesProduit.php"]);
            ModelProduit::delete(rawurldecode($_GET['idproduit']));
        }
        header("Location: ?controller=produit&action=readAll");
    }
}