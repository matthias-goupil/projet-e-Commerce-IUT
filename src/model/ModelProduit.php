<?php
require_once File::build_path(["model","Model.php"]);

class ModelProduit extends Model {
    protected static $primary='idproduit';
    protected static $objet = 'produit';

    protected $idproduit;
    protected $intitule;
    protected $prix;
    protected $stock;
    protected $description;
    protected $nbVue;
    protected $urlImage1;



    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(intitule,prix,stock, description,urlImage1)
                        VALUES(:intitule,:prix,:stock,:description,:urlImage1)"
            );
            $req_prep->execute([
                "intitule" => $this->intitule,
                "prix" => $this->prix,
                "stock" => $this->stock,
                "description" => $this->description,
                "urlImage1" => $this->urlImage1
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



