<?php
class ControllerUtilisateur {
    private static $objet = "utilisateur";

    public static function connexion(){
        require_once File::build_path(["view", "connexion", "connexion.php"]);
    }

    public static function inscription(){
        $view = "inscription";
        $titre = "Inscription";
        require File::build_path(["view","view.php"]);
    }

    public static function connected(){
        echo 'funni clock man';
    }

    public static function create() {
        if(isset($_POST["adresseEmail"]) && isset($_POST["motDePasse"]) && isset($_POST["confirmationMotDePasse"])){
            $adresseEmail = $_POST["adresseEmail"];
            $motDePasse = $_POST["motDePasse"];
            $motDePasseConfirmation = $_POST["confirmationMotDePasse"];

            if(filter_var($adresseEmail, FILTER_VALIDATE_EMAIL)){
                if($motDePasse == $motDePasseConfirmation){
                    require_once File::build_path(["model","ModelUtilisateur.php"]);
                    require_once File::build_path(["model","ModelPanier.php"]);

                    $user = new ModelUtilisateur([
                        "adresseEmail" => $adresseEmail,
                        "motDePasse" => password_hash($motDePasse)
                    ]);
                }
                else{
                    $errorMotDePasse = "Le mot de passe de confirmation est différent du mot de passe donné";
                }
            }
            else{
                $errorEmail = "L'adresse email n'est pas valide";
            }
        }
        else{
            if(isset($_POST["adresseEmail"])){
                $errorEmail = "Veuillez donner une adresse email";
            }

            if(isset($_POST["motDePasse"])){
                $errorMotDePasse = "Veuillez donner un mot de passe";
            }

            if(isset($_POST["confirmationMotDePasse"])){
                $errorMotDePasseConfirmation = "Veuillez donner un mot de passe de confirmation";
            }
        }

        $view = "inscription";
        $titre = "Inscription";
        require File::build_path(["view","view.php"]);
    }

    public static function profil(){

    }
}