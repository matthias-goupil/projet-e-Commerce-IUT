<?php

class ControllerProduit {
    private static $objet = "produit";

    public static function readAll(){
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);

        $tabProduits = ModelProduit::selectAll();
        $view = "list";
        $titre = "liste des produits";

        require File::build_path(["view","view.php"]);
    }

    public static function read(){
        require File::build_path(["model","ModelAvis.php"]);
        require File::build_path(["model","ModelProduit.php"]);

        $produit = ModelProduit::select($_GET['idProduit']);
        $util = ModelAvis::selectUtilisateursByProduit($_GET['idProduit']);
        
        /*if($produit== NULL) {
            $controller=''; 
            $view='error';
            $pagetitle='Erreur'; 
            require File::build_path(array("view","view.php"));
        }
        else {*/

            $controller=''; 
            $view='detail';
            $pagetitle='Détail du produit';
            require File::build_path(array("view","view.php"));   
        //}
    }


    public static function created() {
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);

        $p = new ModelProduit(array(
            "intitule" => $_POST['intitule'], 
            "prix" => $_POST['prix'], 
            "stock" => $_POST['stock'], 
            "description" => $_POST['description'], 
            "urlImage1" => $_POST['urlImage1']));
        $p->save();
        header('Location: ?controller=Produit&action=readAll');
    }

    public static function create(){
        $view = "create";
        $titre ="Gestion Produits";

        require_once File::build_path(array("view", "view.php"));
    }

    public static function update() {
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);
        $view = "create";
        $titre ="Gestion Produits";

        $p = ModelProduit::select($_GET['idproduit']);
        require_once File::build_path(array("view", "view.php"));
    }

    public static function updated(){
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);

        
        $idproduit = $_GET['idproduit'];
        $data = array(
            'idproduit' => $idproduit,
            'intitule' => $_POST['intitule'],
            'prix' => $_POST['prix'],
            'stock' => $_POST['stock'],
            'description' => $_POST['description'],
            'urlImage1' => $_POST['urlImage1']
        );
        ModelProduit::update($data);
        ControllerProduit::readAll();
    }

    public static function deleted() {
        require_once File::build_path(["model","ModelProduit.php"]);
        require_once File::build_path(["model","ModelImagesProduit.php"]);

        ModelProduit::delete($_GET['idproduit']);
        ControllerProduit::readAll();
    }

}