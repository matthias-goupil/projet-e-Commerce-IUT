<?php
require_once File::build_path(["model","Model.php"]);

class ModelUtilisateur extends Model{
    protected static $primary='idUtilisateur';
    protected static $objet = 'utilisateur';

    protected $idUtilisateur;
    protected $idPanier;
    protected $adresseEmail;
    protected $nom;
    protected $prenom;
    protected $motDePasse;
    protected $role;
    protected $adressePostale;
    protected $ville;
    protected $codePostal;

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
}