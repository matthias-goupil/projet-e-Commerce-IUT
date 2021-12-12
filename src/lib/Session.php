<?php
session_start();


class Session
{
    public static function createUser($idUtilisateur,$admin){
        $_SESSION["idUtilisateur"] = $idUtilisateur;
        $_SESSION["isAdmin"] = $admin;
    }

    public static function createCart(){
        $_SESSION["cart"] = [];
    }

    public static function insertProduitIntoKart($idProduit,$quantite){
        require_once File::build_path(["model","ModelProduit.php"]);
        $produit = ModelProduit::select($idProduit);
        if(!self::cartIsCreate()){
            self::createCart();
        }
        if(!self::incrementQuantiteProduitInCart($idProduit,$quantite)){
            $_SESSION["cart"][] = [
                "produit" => serialize($produit),
                "quantite" => $quantite
            ];
        }
    }

    public static function incrementQuantiteProduitInCart($idProduit,$quantite){
        require_once File::build_path(["model","ModelProduit.php"]);
        if(!self::cartIsCreate()){
            self::createCart();
        }
        for($i = 0; $i < count($_SESSION["cart"]); $i++){
            if(unserialize($_SESSION["cart"][$i]["produit"])->get("idproduit") == $idProduit){
                $_SESSION["cart"][$i]["quantite"] += $quantite;
                return true;
            }
        }
        return false;
    }

    public static function decrementQuantiteProduitInCart($idProduit,$quantite){
        if(!self::cartIsCreate()){
            self::createCart();
        }
        require_once File::build_path(["model","ModelProduit.php"]);
        for($i = 0; $i < count($_SESSION["cart"]); $i++){
            if(unserialize($_SESSION["cart"][$i]["produit"])->get("idproduit") == $idProduit){
                $_SESSION["cart"][$i]["quantite"] -= $quantite;
                if($_SESSION["cart"][$i]["quantite"] <= 0){
                    unset($_SESSION["cart"][$i]);
                }
                return true;
            }
        }
        return false;
    }

    public static function updateProduitInCart($idProduit,$quantite){
        if(!self::cartIsCreate()){
            self::createCart();
        }
        require_once File::build_path(["model","ModelProduit.php"]);
        for($i = 0; $i < count($_SESSION["cart"]); $i++){
            if(unserialize($_SESSION["cart"][$i]["produit"])->get("idproduit") == $idProduit){
                $_SESSION["cart"][$i]["quantite"] = $quantite;
                return true;
            }
        }
        return false;
    }

    public static function removeProduitFromCart($idProduit){
        if(!self::cartIsCreate()){
            self::createCart();
        }
        foreach($_SESSION["cart"] as $produit){
            if(isset($produit["idProduit"]) && unserialize($produit["produit"])->get("idProduit") == $idProduit){
                unset($produit);
                break;
            }
        }
    }

    public static function getCart(){
        if(!self::cartIsCreate()){
            self::createCart();
        }
        return $_SESSION["cart"];

    }

    public static function getIdUtilisateur(){
        if(self::userIsCreate()){
            return $_SESSION["idUtilisateur"];
        }
        return false;
    }

    public static function userIsAdmin(){
        if(self::userIsCreate()){
            return $_SESSION["isAdmin"];
        }
        return false;
    }

    public static function userIsCreate(){
        return isset($_SESSION["idUtilisateur"]);
    }

    public static function cartIsCreate(){
        return isset($_SESSION["cart"]);
    }

    public static function destroyUser(){
        if(isset($_SESSION["idUtilisateur"])){
            session_unset();
        }
    }
}