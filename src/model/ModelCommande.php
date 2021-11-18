<?php
require_once File::build_path(["model","Model.php"]);

class ModelCommande extends Model{
    protected static $primary='idCommande';
    protected static $objet = 'commande';

    protected $idCommande;
    protected $idUtilisateur;
    protected $idPanier;
    protected $nom;
    protected $prenom;
    protected $adresse;
    protected $ville;
    protected $codePostal;
    protected $numeroTelephone;
    protected $dateLivraison;
    protected $dateCommande;

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idUtilisateur,idPanier,nom,prenom,adresse,ville,codePostal,numeroTelephone,dateLivraison,dateCommande)
                         VALUES(:idUtilisateur,:idPanier,:nom,:prenom,:adresse,:ville,:codePostal,:numeroTelephone,:dateLivraison,:dateCommande)"
            );
            $req_prep->execute([
                "idUtilisateur" => $this->idUtilisateur,
                "idPanier" => $this->idPanier,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "adresse" => $this->adresse,
                "ville" => $this->ville,
                "codePostal" => $this->codePostal,
                "numeroTelephone" => $this->numeroTelephone,
                "dateLivraison" => $this->dateLivraison,
                "dateCommande" => $this->dateCommande
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