<?php
require_once File::build_path(["model","Model.php"]);

class ModelUtilisateur extends Model{
    protected static $primary='idUtilisateur';
    protected static $objet = 'utilisateur';

    protected $idUtilisateur;
    protected $idPanier;
    protected $adresseEmail;
    protected $nom =""; // CAN BE NULL
    protected $prenom = ""; // CAN BE NULL
    protected $motDePasse = ""; // CAN BE NULL
    protected $role = "Visiteur"; // CAN BE NULL
    protected $adressePostale = ""; // CAN BE NULL
    protected $ville = ""; // CAN BE NULL
    protected $codePostal = ""; // CAN BE NULL

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idPanier,adresseEmail,nom,prenom,motDePasse,role,adressePostale,ville,codePostal)
                         VALUES(:idPanier,:adresseEmail,:nom,:prenom,:motDePasse,:role,:adressePostale,:ville,:codePostal)"
            );
            $req_prep->execute([
                "idPanier" => $this->idPanier,
                "adresseEmail" => $this->adresseEmail,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "motDePasse" => $this->motDePasse,
                "role" => $this->role,
                "adresseEmail" => $this->adresseEmail,
                "adressePostale" => $this->adressePostale,
                "ville" => $this->ville,
                "codePostal" => $this->codePostal
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
                "SELECT COUNT(*) 
                 FROM $table_name 
                 WHERE adresseEmail = :adresseEmail
                 AND motDePasse = :motDePasse"
            );

            $req_prep->execute([
                "adresseEmail" => $motDePasse,
                "motDePasse" => $motDePasse
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
}