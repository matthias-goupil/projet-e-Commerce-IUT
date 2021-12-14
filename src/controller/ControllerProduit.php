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
        if(Session::userIsAdmin()) {
            if (isset($_POST['intitule']) && isset($_POST['prix']) && isset($_POST['stock']) && isset($_POST['description']) && isset($_POST['urlImage1'])) {
                if (!empty($_POST['intitule']) && !empty($_POST['prix']) && !empty($_POST['stock']) && !empty($_POST['description']) && !empty($_POST['urlImage1'])) {

                    require_once File::build_path(["model", "ModelProduit.php"]);
                    require_once File::build_path(["model", "ModelImagesProduit.php"]);

                    $p = new ModelProduit(array(
                        "intitule" => $_POST['intitule'],
                        "prix" => $_POST['prix'],
                        "stock" => $_POST['stock'],
                        "description" => $_POST['description'],
                        "urlImage1" => $_POST['urlImage1']));
                    $p->save();

                } else {
                    header('Location: ?controller=Produit&action=create');
                }
            } else {
                header('Location: ?controller=Produit&action=create');
            }
        }
        header('Location: ?controller=produit&action=readAll');
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
            if(isset($_GET['idproduit']) && isset($_POST['intitule']) && isset($_POST['prix']) && isset($_POST['stock']) && isset($_POST['description']) && isset($_POST['urlImage1'])){
                if(!empty($_GET['idproduit']) && !empty($_POST['intitule']) && !empty($_POST['prix']) && !empty($_POST['stock']) && !empty($_POST['description']) && !empty($_POST['urlImage1'])){
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
                else{
                    header("Location: ?controller=produit&action=update");
                }
            }
            else{
                header("Location: ?controller=produit&action=update");
            }
        }
        header("Location: ?controller=produit&action=readAll");
    }

    public static function deleted() {
        if(Session::userIsAdmin()){
            if(isset($_GET["idproduit"])){
                if(!empty($_GET["idproduit"])){
                    require_once File::build_path(["model","ModelProduit.php"]);
                    require_once File::build_path(["model","ModelImagesProduit.php"]);
                    ModelProduit::delete(rawurldecode($_GET['idproduit']));
                }
                else{
                    header("Location: ?controller=produit&action=readAll");
                }
            }
            else{
                header("Location: ?controller=produit&action=readAll");
            }

        }
        header("Location: ?controller=produit&action=readAll");
    }
}