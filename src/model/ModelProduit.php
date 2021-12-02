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
    protected $idImagesProduit;
    protected $urlImage1;
    protected $urlImage2;
    protected $urlImage3;
    protected $urlImage4;
    protected $urlImage5;


    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(intitule,prix,stock, description,nbVue,:idImagesProduit)
                        VALUES(:intitule,:prix,:stock,:description, :nbVue,:idImagesProduit)"
            );
            $req_prep->execute([
                "intitule" => $this->intotule,
                "prix" => $this->prix,
                "stock" => $this->stock,
                "description" => $this->description,
                "nbVue" => $this->nbVue,
                "idImagesProduit" => $this->idImagesProduit
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



