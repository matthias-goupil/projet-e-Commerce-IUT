<?php
require_once File::build_path(["config","Conf.php"]);

abstract class Model{
    private static $pdo = null;

    private static function init() {
        try {
            self::$pdo = new PDO("mysql:host=".Conf::getHostname().";dbname=".Conf::getDatabase(),Conf::getLogin(), Conf::getPassword(), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public function __construct($data = NULL){
        if(!is_null($data)){
            $this->hydrate($data);
        }
    }

    protected static function getPdo() {
        if (is_null(self::$pdo)) self::init();
        return self::$pdo;
    }

    public function hydrate($data = NULL){
        foreach ($data as $attribut => $value){
            $this->set($attribut,$value);
        }
    }

    //getter
    public function get($attribut){
        if(property_exists($this,$attribut)){
            return $this->$attribut;
        }
        return null;
    }

    // setters

    public function set($attribut, $value){
        $method = "set".ucfirst($attribut);
        if(method_exists($this,$method)){
            $this->$method($value);
        }
        else{
            if(property_exists($this,$attribut)){
                $this->$attribut = $value;
            }
        }
    }

    public static function selectAll(): array{
        try{
            $table_name = "ECommerce__" . ucfirst(static::$objet);
            $class_name = "Model".ucfirst(static::$objet);
            $rep = self::getPdo()->query(
                "SELECT * FROM $table_name "
            );

            $rep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            return $rep->fetchAll();
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

    public static function select($primary_value) {
        try {
            $table_name = "ECommerce__".ucfirst(static::$objet);
            $class_name = "Model".ucfirst(static::$objet);
//            $primary_key = static::$primary;
            $primary_keys = static::$primary;
            $sql = "SELECT * FROM $table_name WHERE ";
            $data = [];
            foreach ($primary_value as $key => $value){
                if(in_array($key,$primary_keys,false)){
                    $sql .= $key." =:".$key." , ";
                    $data[$key] = $value;
                }
            }
            $sql = rtrim($sql,",");


            $req_prep = Model::getPdo()->prepare($sql);
//            $req_prep = Model::getPDO()->prepare("SELECT * from $table_name WHERE $primary_key =:primarykey");

            $req_prep->execute($data);
//            $req_prep->execute(array(
//                "primarykey" => $primary_value
//            ));

            $req_prep->setFetchMode(PDO::FETCH_CLASS, $class_name);
            $object = $req_prep->fetch();

            // Attention, si il n'y a pas de résultats, on renvoie false
            if (empty($object))
                return false;
            return new $class_name($object);

        } catch (PDOException $e) {
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function delete($primary_value){
        try{
            $table_name = "ECommerce__" . ucfirst(static::$objet);
            $primary_key = static::$primary;

            $req_prep = Model::getPdo()->prepare(
                "DELETE FROM $table_name WHERE $primary_key=:primarykey"
            );
            $req_prep->execute([
                'primarykey' => $primary_value,
            ]);
        }catch(PDOException $e){
            if (Conf::getDebug()) {
                echo $e->getMessage(); // affiche un message d'erreur
            } else {
                echo 'Une erreur est survenue <a href=""> retour a la page d\'accueil </a>';
            }
            die();
        }
    }

    public static function update($data){
        $table_name = "ECommerce__" . ucfirst(static::$objet);
        $primary_key = static::$primary;

        try{
            $string = "";
            foreach($data as $key => $value){
                if($key != $primary_key) {
                    $string .= $key . "=:" . $key . ",";
                }
            }
            $string = rtrim($string,",");
            $req_prep = Model::getPdo()->prepare(
                "UPDATE $table_name SET $string WHERE $primary_key = :$primary_key"
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