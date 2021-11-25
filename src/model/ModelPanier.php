<?php
require_once File::build_path(["model","Model.php"]);

class ModelPanier extends Model{
    protected static $primary='idPanier';
    protected static $objet = 'panier';

    protected $idPanier;
    protected $prixTotal;

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(prixTotal)
                         VALUES(:prixTotal)"
            );
            $req_prep->execute([
                "prixTotal" => $this->prixTotal
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