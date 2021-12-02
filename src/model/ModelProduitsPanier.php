<?php
require_once File::build_path(["model","Model.php"]);

class ModelProduitsPanier extends Model {
    protected static $primary='#';
    protected static $objet = 'produitsPanier';

    protected $idProduit;
    protected $idPanier;
    protected $quantite;

    
    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idProduit,idPanier,quantite)
                        VALUES(:idProduit,:idPanier,:quantite)"
            );
            $req_prep->execute([
                "idProduit" => $this->idProduit,
                "idPanier" => $this->idPanier,
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

    public static function selectAllProduitsPanier(): array{
        require_once File::build_path(["model","ModelProduit.php"]);
        try{
            $table_name = "ECommerce__" . ucfirst(static::$objet);
            $class_name = "Model".ucfirst(static::$objet);
            $rep = self::getPdo()->query(
                "SELECT * 
                 FROM $table_name pa
                 JOIN ECommerce__Produit p
                 ON pa.idProduit = p.idproduit"
            );

            $data = [];
            while($object = $rep->fetch(PDO::FETCH_ASSOC)){
                $data[] = [
                    "produitsPanier" => new $class_name($object),
                    "produit" => new ModelProduit($object)
                ];    
                
            }
             return $data;
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



    public static function ajouterProduit($data){
        $table_name = "ECommerce__" . ucfirst(static::$objet);

        try{
            $req_prep = Model::getPdo()->prepare(
                "UPDATE ECommerce__ProduitsPanier SET quantite = quantite + 1 WHERE idProduit =:idProduit"
            );
            $req_prep->execute($data);
        }catch(PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                ControllerGeneral::error();
            }
            die();
        }
    }

    public static function supprimerProduit($data){
        $table_name = "ECommerce__" . ucfirst(static::$objet);

        try{
            $req_prep = Model::getPdo()->prepare(
                "UPDATE ECommerce__ProduitsPanier SET quantite = quantite - 1 WHERE idProduit =:idProduit"
            );
            $req_prep->execute($data);
        }catch(PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                ControllerGeneral::error();
            }
            die();
        }
    }

}
