<?php
require_once File::build_path(["model","Model.php"]);

class ModelProduit extends Model {
    protected static $primary='idproduit';
    protected static $objet = 'ECommerce__produit';

    protected $idproduit;
    protected $intitule;
    protected $prix;
    protected $quantite;
    protected $description;
    protected $nbVue;
    
    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(intitule,prix,quantite, description,nbVue)
                        VALUES(:intitule,:prix,:quantite,:description, :nbVue)"
            );
            $req_prep->execute([
                "intitule" => $this->intotule,
                "prix" => $this->prix,
                "quantite" => $this->quantite,
                "description" => $this->description,
                "nbVue" => $this->nbVue
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



