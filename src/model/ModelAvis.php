<?php
require_once File::build_path(["model","Model.php"]);

class ModelAvis extends Model{
    protected static $primary='idAvis';
    protected static $objet = 'avis';

    protected $idAvis;
    protected $idProduit;
    protected $idUtilisateur;
    protected $commentaire;
    protected $note;

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idProduit,idUtilisateur,commentaire, note)
                         VALUES(:idProduit,:idUtilisateur,:commentaire,:note)"
            );
            $req_prep->execute([
                "idProduit" => $this->idProduit,
                "idUtilisateur" => $this->idUtilisateur,
                "commentaire" => $this->commentaire,
                "note" => $this->note
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