<?php
class ControllerUtilisateur {
    private static $objet = "utilisateur";

    public static function connexion(){
        if(!Session::userIsCreate()){
            $view = "connexion";
            $titre = "Connexion";
            require_once File::build_path(["view","view.php"]);
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function inscription(){
        if(!Session::userIsCreate()){
            $view = "inscription";
            $titre = "Inscription";
            require File::build_path(["view","view.php"]);
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function connected(){
       if(!Session::userIsCreate()){
           if(isset($_POST["adresseEmail"]) && isset($_POST["motDePasse"])){
               $adresseEmail = $_POST["adresseEmail"];
               $motDePasse = Security::hacher($_POST["motDePasse"]);

               if(filter_var($adresseEmail, FILTER_VALIDATE_EMAIL)){
                   require_once File::build_path(["model","ModelUtilisateur.php"]);
                   if($userID = ModelUtilisateur::checkPassword($adresseEmail,$motDePasse)){
                       $user = ModelUtilisateur::select($userID);
                       var_dump($user);
                       if($user->get("nonce") == "NULL"){
                            Session::createUser($userID,$user->get("role") == "Administrateur");
                            header("Location: ?controller=produit&action=readAll");
                       }
                       else{
                           header("Location: ?controller=utilisateur&action=messageConfirmation&idUtilisateur=".$userID);
                       }
                   }
                   else{
                       $errorMotDePasse = "Les identifiants sont faux";
                   }
               }
               else{
                   if(isset($_POST["adresseEmail"])){
                       $errorEmail = "Veuillez donner une adresse email";
                   }

                   if(isset($_POST["motDePasse"])){
                       $errorMotDePasse = "Veuillez donner un mot de passe";
                   }
               }
           }
           $view = "connexion";
           $titre = "Connexion";
           require_once File::build_path(["view","view.php"]);
       }
       else{
           header("Location: ?controller=produit&action=readAll");
       }

    }

    public static function create() {
        if(!Session::userIsCreate()){
            if(isset($_POST["adresseEmail"]) && isset($_POST["motDePasse"]) && isset($_POST["confirmationMotDePasse"])){
                    $adresseEmail = $_POST["adresseEmail"];
                    $motDePasse = $_POST["motDePasse"];
                    $motDePasseConfirmation = $_POST["confirmationMotDePasse"];

                    if(filter_var($adresseEmail, FILTER_VALIDATE_EMAIL)){
                        if($motDePasse == $motDePasseConfirmation){
                            require_once File::build_path(["model","ModelUtilisateur.php"]);
                            if(!ModelUtilisateur::adresseEmailExists($adresseEmail)){
                                $motDePasse = Security::hacher($motDePasse);
                                $user = new ModelUtilisateur([
                                    "adresseEmail" => $adresseEmail,
                                    "motDePasse" => $motDePasse,
                                    "nonce" => Security::generateRandomHex()
                                ]);
                                $user->save();
                                $userID = ModelUtilisateur::checkPassword($adresseEmail,$motDePasse);

                                header("Location: ?controller=utilisateur&action=messageConfirmation&idUtilisateur=".$userID);
                            }
                            else{
                                $errorEmail = "L'adresse email est déjà utilisée par un utilisateur";
                            }

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
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function validate(){
        if(!Session::userIsCreate()){
            if(isset($_GET["idUtilisateur"]) && isset($_GET["nonce"])){
                $idUtilisateur = $_GET["idUtilisateur"];
                $nonce = $_GET["nonce"];
                require_once File::build_path(["model","ModelUtilisateur.php"]);
                if($nonce == ModelUtilisateur::getNonce($idUtilisateur)){
                    ModelUtilisateur::update([
                        "idUtilisateur" => $idUtilisateur,
                        "nonce" => "NULL"
                    ]);
                    $view = "validate";
                    $pageTitle = "Confirmation création de compte";
                    require File::build_path(["view","view.php"]);
                }
                else{
                    header("Location: ?controller=produit&action=readAll");
                }
            }
            else{
                header("Location: ?controller=produit&action=readAll");
            }
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function messageConfirmation(){
        if(!Session::userIsCreate()){
            if(isset($_GET["idUtilisateur"])){
                require_once File::build_path(["model","ModelUtilisateur.php"]);
                if($user = ModelUtilisateur::select($_GET["idUtilisateur"])){
                    if($user->get("nonce") != "NULL"){
                        $view = "messageConfirmation";
                        $titre = "C";
                        require File::build_path(["view","view.php"]);
                    }
                    else{
                        header("Location: ?controller=produit&action=readAll");
                    }
                }
                else{
                    header("Location: ?controller=produit&action=readAll");
                }
            }
            else{
                header("Location: ?controller=produit&action=readAll");
            }
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

    public static function profil(){
        if(!Session::userIsCreate()){

        }
        else{
            header("Location:");
        }
    }

    public static function motDePasseOublie(){

    }
}