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
                "INSERT INTO $table_name(urlImages1,urlImages2,urlImages3,urlImages4,urlImages5)
                         VALUES(:urlImages1,:urlImages2,:urlImages3,:urlImages4,:urlImages5)"
            );
            $req_prep->execute([
                "urlImages1" => $this->urlImages1,
                "urlImages2" => $this->urlImages2,
                "urlImages3" => $this->urlImages3,
                "urlImages4" => $this->urlImages4,
                "urlImages5" => $this->urlImages5
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