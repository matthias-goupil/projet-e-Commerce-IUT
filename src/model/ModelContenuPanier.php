<?php
require_once File::build_path(["model","Model.php"]);

class ModelContenuPanier extends Model {
    protected static $primary='#';
    protected static $objet = 'contenuPanier';

    protected $idProduit;
    protected $idPanier;
    protected $quantite;

    public function save(){
        try{
            $table_name = "ECommerce__".ucfirst(self::$objet);
            $req_prep = Model::getPdo()->prepare(
                "INSERT INTO $table_name(idProduit,idPanier,quantite)
                        VALUES(:idProduit,:idPanier,:quantite)
                  "
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

    public static function selectAllProduitsPanierByIdUtilisateur($idUtilisateur): array{
        require_once File::build_path(["model","ModelProduit.php"]);
        try{
            $table_name = "ECommerce__" . ucfirst(static::$objet);
            $class_name = "Model".ucfirst(static::$objet);
            $rep = self::getPdo()->prepare(
                "SELECT * 
                 FROM $table_name cpa
                 JOIN ECommerce__Produit p ON cpa.idProduit = p.idproduit
                 JOIN ECommerce__Panier pa ON cpa.idPanier = pa.idPanier
                 WHERE idUtilisateur = :idUtilisateur"

            );
            
            $rep->execute([
            "idUtilisateur" => $idUtilisateur
            ]);

            $data = [];
            while($object = $rep->fetch(PDO::FETCH_ASSOC)){
                $data[] = [
                    "contenuPanier" => new $class_name($object),
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

    public static function selectAllProduitPanierByIdPanier($idPanier): array{
        require_once File::build_path(["model","ModelProduit.php"]);
        try{
            $table_name = "ECommerce__" . ucfirst(static::$objet);
            $class_name = "Model".ucfirst(static::$objet);
            $rep = self::getPdo()->prepare(
                "SELECT * 
                 FROM $table_name cpa
                 JOIN ECommerce__Produit p ON cpa.idProduit = p.idproduit
                 WHERE idPanier = :idPanier"

            );
            
            $rep->execute([
            "idPanier" => $idPanier
            ]);

            $data = [];
            while($object = $rep->fetch(PDO::FETCH_ASSOC)){
                $data[] = [
                    "contenuPanier" => new $class_name($object),
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
                "UPDATE $table_name cpa
                JOIN ECommerce__Produit p ON cpa.idProduit = p.idproduit
                JOIN ECommerce__Panier pa ON cpa.idPanier = pa.idPanier
                SET quantite = quantite + :quantite 
                WHERE idUtilisateur = :idUtilisateur AND cpa.idProduit =:idProduit"
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

    public static function selectQuantite($idProduit) {
        $table_name = "ECommerce__" . ucfirst(static::$objet);

        $sql = "SELECT quantite FROM $table_name cpa
        JOIN ECommerce__Produit p ON cpa.idProduit = p.idproduit
        JOIN ECommerce__Panier pa ON cpa.idPanier = pa.idPanier
        WHERE cpa.idProduit=:nom_tag AND idUtilisateur =:idUtilisateur";
        // Préparation de la requête
        $req_prep = Model::getPDO()->prepare($sql);
    
        $values = array(
            "nom_tag" => $idProduit,
            "idUtilisateur" => Session::getIdUtilisateur()
            //nomdutag => valeur, ...
        );
        // On donne les valeurs et on exécute la requête	 
        $req_prep->execute($values);
    
        // On récupère les résultats comme précédemment
        $data = $req_prep->fetch(PDO::FETCH_ASSOC);
        // Attention, si il n'y a pas de résultats, on renvoie false
        return $data;
    }

    public static function supprimerProduit($data){
        $table_name = "ECommerce__" . ucfirst(static::$objet);
        $quantite = ModelContenuPanier::selectQuantite($data['idProduit']);
        try{
            if($quantite['quantite'] < $data["quantite"] + 1){
                unset($data["quantite"]);
                $req_prep = Model::getPdo()->prepare("DELETE FROM ECommerce__ContenuPanier
                                                                                WHERE idProduit = :idProduit AND idPanier = (SELECT pa.idPanier
                                                                                                                    FROM ECommerce__Panier pa
                                                                                                                    WHERE pa.idUtilisateur = :idUtilisateur)");
            }
            else{
                $req_prep = Model::getPdo()->prepare(" UPDATE $table_name cpa
                                                                    JOIN ECommerce__Produit p
                                                                    ON cpa.idProduit = p.idproduit
                                                                    JOIN ECommerce__Panier pa
                                                                    ON cpa.idPanier = pa.idPanier
                                                                    SET quantite = quantite - :quantite 
                                                                    WHERE idUtilisateur = :idUtilisateur AND cpa.idProduit =:idProduit");
            }

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

    public static function produitExists($idProduit,$idutilisateur){
        $table_name = "ECommerce__" . ucfirst(static::$objet);
        try{
            $req_prep = Model::getPdo()->prepare(
                "SELECT COUNT(*)
                FROM $table_name cp
                JOIN ECommerce__Panier p ON p.idPanier = cp.idPanier
                WHERE idProduit = :idProduit
                    AND idUtilisateur = :idUtilisateur 
                "
            );
            $req_prep->execute([
                    "idProduit" => $idProduit,
                    "idUtilisateur" => $idutilisateur
                ]);

            return $req_prep->fetch()[0] == 1;
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
