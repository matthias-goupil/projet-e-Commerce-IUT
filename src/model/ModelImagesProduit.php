<?php
require_once File::build_path(["model","Model.php"]);

class ModelImagesProduit extends Model{
    protected static $primary='idImagesProduit';
    protected static $objet = 'imagesProduit';

    protected $urlImage1;
    protected $urlImage2;
    protected $urlImage3;
    protected $urlImage4;
    protected $urlImage5;

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(urlImage1,urlImage2,urlImage3,urlImage4,urlImage5)
                         VALUES(:urlImage1,:urlImage2,:urlImage3,:urlImage4,:urlImage5)"
            );
            $req_prep->execute([
                "urlImage1" => $this->urlImage1,
                "urlImage2" => $this->urlImage2,
                "urlImage3" => $this->urlImage3,
                "urlImage4" => $this->urlImage4,
                "urlImage5" => $this->urlImage5
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