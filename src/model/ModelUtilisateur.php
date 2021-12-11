<?php
require_once File::build_path(["model","Model.php"]);

class ModelUtilisateur extends Model{
    protected static $primary='idUtilisateur';
    protected static $objet = 'utilisateur';

    protected $idUtilisateur;
    protected $adresseEmail;
    protected $nom =""; // CAN BE NULL
    protected $prenom = ""; // CAN BE NULL
    protected $motDePasse = ""; // CAN BE NULL
    protected $role = "Consommateur"; // CAN BE NULL
    protected $adressePostale = ""; // CAN BE NULL
    protected $ville = ""; // CAN BE NULL
    protected $codePostal = ""; // CAN BE NULL
    protected $nonce = "";

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(adresseEmail,nom,prenom,motDePasse,role,adressePostale,ville,codePostal,nonce)
                         VALUES(:adresseEmail,:nom,:prenom,:motDePasse,:role,:adressePostale,:ville,:codePostal,:nonce)"
            );
            $req_prep->execute([
                "adresseEmail" => $this->adresseEmail,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "motDePasse" => $this->motDePasse,
                "role" => $this->role,
                "adresseEmail" => $this->adresseEmail,
                "adressePostale" => $this->adressePostale,
                "ville" => $this->ville,
                "codePostal" => $this->codePostal,
                "nonce" => $this->nonce
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

    public static function checkPassword($adresseEmail,$motDePasse){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);

            $req_prep = Model::getPdo()->prepare(
                "SELECT idUtilisateur 
                 FROM $table_name 
                 WHERE adresseEmail = :adresseEmail
                 AND motDePasse = :motDePasse"
            );

            $req_prep->execute([
                "adresseEmail" => $adresseEmail,
                "motDePasse" => $motDePasse
            ]);

            if($data = $req_prep->fetch()){
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

    public static function selectIdPanier($idUtilisateur){
        try{
            $table_name = "ECommerce__Panier";
            $req_prep = Model::getPdo()->prepare(
                "SELECT idPanier FROM $table_name
                 WHERE idUtilisateur = :idUtilisateur
                  "
            );
            $req_prep->execute([
                "idUtilisateur" => $idUtilisateur
            ]);

            return $req_prep->fetch()[0];
        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                ControllerGeneral::error();
            }
            die();
        }
    }

    public static function adresseEmailExists($adresseEmail){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);

            $req_prep = Model::getPdo()->prepare(
                "SELECT COUNT(*) 
                 FROM $table_name 
                 WHERE adresseEmail = :adresseEmail"
            );

            $req_prep->execute([
                "adresseEmail" => $adresseEmail
            ]);

            return $req_prep->fetch()[0] == 1;
        }catch (PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                ControllerGeneral::error();
            }
            die();
        }
    }

    public static function getNonce($idUtilisateur){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "SELECT nonce 
                 FROM $table_name 
                 WHERE idUtilisateur = :idUtilisateur
                 AND nonce IS NOT NULL"
            );

            $req_prep->execute([
                "idUtilisateur" => $idUtilisateur
            ]);

            if($data = $req_prep->fetch()){
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