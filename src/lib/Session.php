<?php
session_start();
require_once File::build_path(["model","ModelProduit.php"]);

class Session
{
    public static function createUser($idUtilisateur,$admin){
        $_SESSION["idUtilisateur"] = $idUtilisateur;
        $_SESSION["isAdmin"] = $admin;
    }

    public static function createCart(){
        $_SESSION["cart"] = [];
    }

    public static function insertProduitIntoKart($produit,$quantite){
        if(!self::updateProduitInCart($produit->get("idProduit"),$quantite)){
            $_SESSION["cart"][] = [
                "produit" => $produit,
                "quantite" => $quantite
            ];
        }
    }

    public static function incrementQuantiteProduitInCart($idProduit){
        foreach($_SESSION["cart"] as $produit){
            if(isset($produit["produit"]) && $produit["produit"]->get("idProduit") == $idProduit){
                $produit["quantite"]++;
                return true;
            }
        }
        return false;
    }

    public static function decrementQuantiteProduitInCart($idProduit){
        foreach($_SESSION["cart"] as $produit){
            if(isset($produit["produit"]) && $produit["produit"]->get("idProduit") == $idProduit){
                $produit["quantite"]++;
                return true;
            }
        }
        return false;
    }

    public static function updateProduitInCart($idProduit,$quantite){
        foreach($_SESSION["cart"] as $produit){
            if(isset($produit["produit"]) && $produit["produit"]->get("idProduit") == $idProduit){
                $produit["quantite"] = $quantite;
                return true;
            }
        }
        return false;
    }

    public static function removeProduitFromCart($idProduit){
        foreach($_SESSION["cart"] as $produit){
            if(isset($produit["idProduit"]) && $produit["idProduit"]->get("idProduit") == $idProduit){
                unset($produit);
                break;
            }
        }
    }

    public static function getKart(){
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