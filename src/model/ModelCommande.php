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
    protected $adresseLivraison;
    protected $villeLivraison;
    protected $codePostalLivraison;
    protected $numeroTelephone;
    protected $dateLivraison = "";
    protected $dateCommande;

    public function save(){
        try{
            $req_prep = Model::getPdo()->prepare("
                UPDATE ECommerce__Panier SET actuel = 0 WHERE actuel = 1 AND idUtilisateur = :idUtilisateur
            ");

            $req_prep->execute([
                "idUtilisateur" => $this->idUtilisateur
            ]);

            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idUtilisateur,idPanier,nom,prenom,adresseLivraison,villeLivraison,codePostalLivraison,numeroTelephone,dateLivraison)
                         VALUES(:idUtilisateur,:idPanier,:nom,:prenom,:adresseLivraison,:villeLivraison,:codePostalLivraison,:numeroTelephone,:dateLivraison)"
            );
            $req_prep->execute([
                "idUtilisateur" => $this->idUtilisateur,
                "idPanier" => $this->idPanier,
                "nom" => $this->nom,
                "prenom" => $this->prenom,
                "adresseLivraison" => $this->adresseLivraison,
                "villeLivraison" => $this->villeLivraison,
                "codePostalLivraison" => $this->codePostalLivraison,
                "numeroTelephone" => $this->numeroTelephone,
                "dateLivraison" => $this->dateLivraison
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

    public static function selectAllCommandesByIdUtilisateur($idUtilisateur): array{
        try{
            $table_name = "ECommerce__" . ucfirst(static::$objet);
            $class_name = "Model".ucfirst(static::$objet);
            $rep = self::getPdo()->prepare(
                "SELECT * FROM $table_name WHERE idUtilisateur = :idUtilisateur"
            );

            $rep->execute([
                "idUtilisateur" => $idUtilisateur
                ]);

            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $rep->fetchAll();
        } 
        catch(PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }
}