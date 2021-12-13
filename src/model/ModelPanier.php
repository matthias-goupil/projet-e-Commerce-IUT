<?php
require_once File::build_path(["model","Model.php"]);

class ModelPanier extends Model{
    protected static $primary='idPanier';
    protected static $objet = 'panier';

    protected $idPanier;
    protected $idUtilisateur;
    protected $prixTotal = 0;
    protected $actuel;

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(prixTotal,idUtilisateur)
                         VALUES(:prixTotal,:idUtilisateur)"
            );
            $req_prep->execute([
                "prixTotal" => $this->prixTotal,
                "idUtilisateur" => $this->idUtilisateur
            ]);

        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                ControllerGeneral::error();
            }
            die();
        }
    }

    public static function getIdPanierByUserID($idUtilisateur){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "SELECT idPanier FROM $table_name 
                WHERE idUtilisateur = :idUtilisateur 
                AND actuel = 1"
            );
            $req_prep->execute([
                "idUtilisateur" => $idUtilisateur
            ]);

            $data = $req_prep->fetch();
            print_r($data);
            if(count($data) != 0){
                return $data[0];
            }
            return false;
        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                ControllerGeneral::error();
            }
            die();
        }
    }
}