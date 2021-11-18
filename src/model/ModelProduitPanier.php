<?php
require_once File::build_path(["model","Model.php"]);

class ModelProduit extends Model {
    protected static $primary='idproduit';
    protected static $objet = 'produit';

    protected $idProduit;
    protected $idPanier;
    protected $quantite;

    
    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idProduit,quantite)
                        VALUES(:idProduit,:quantite)"
            );
            $req_prep->execute([
                "idProduit" => $this->idProduit,
                "quantite" => $this->quantite
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
