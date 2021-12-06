<?php
session_start();

class Session
{
    public static function createUser($idUtilisateur,$admin){
        $_SESSION["idUtilisateur"] = $idUtilisateur;
        $_SESSION["isAdmin"] = $admin;
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

    public static function destroyUser(){
        if(isset($_SESSION["idUtilisateur"])){
            session_unset();
        }
    }
}