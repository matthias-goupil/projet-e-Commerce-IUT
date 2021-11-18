<?php
class Conf {
    static private $databasesIUT = [
        'hostname' => 'webinfo.iutmontp.univ-montp2.fr',
        'database' => 'goupilm',
        'login' => 'goupilm',
        'password' => '071043647CG'
    ];

    static private $dataBasesLocal = [
        'hostname' => 'localhost',
        'database' => 'Projet-E-Commerce-IUT',
        'login' => 'root',
        'password' => ''
    ];

    static private $debug = true;
    static private $local = false;

    static public function getLogin() {
        if(self::$local){
            return self::$dataBasesLocal['login'];
        }
        return self::$databasesIUT['login'];
    }

    static public function getPassword() {
        if(self::$local){
            return self::$dataBasesLocal['password'];
        }
        return self::$databasesIUT['password'];
    }

    static public function getDatabase() {
        if(self::$local){
            return self::$dataBasesLocal['database'];
        }
        return self::$databasesIUT['database'];
    }

    static public function getHostname() {
        if(self::$local){
            return self::$dataBasesLocal['hostname'];
        }
        return self::$databasesIUT['hostname'];
    }

    static public function getDebug() {
        return self::$debug;
    }
}