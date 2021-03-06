<?php
class ControllerUtilisateur {
    private static $objet = "utilisateur";

    public static function readAll(){
        if(Session::userIsAdmin()){
            require_once File::build_path(["model","ModelUtilisateur.php"]);
            $tabUtilisateurs = ModelUtilisateur::selectAll();
            $view = "list";
            $titre = "Liste des utilisateurs";
            require_once File::build_path(["view","view.php"]);
        }
        else{
            header("Location: ?controller=produit&action=readAll");
        }
    }

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
                       if($user->get("nonce") == ""){
                            Session::createUser($userID,$user->get("role") == "Administrateur");
                            $panierSession = Session::getCart();
                            if(count($panierSession) != 0){
                                require_once File::build_path(["model","ModelContenuPanier.php"]);
                                require_once File::build_path(["model","ModelProduit.php"]);
                                foreach (Session::getCart() as $line){
                                    $produit = unserialize($line["produit"]);
                                    if(ModelContenuPanier::produitExists($produit->get("idproduit"),Session::getIdUtilisateur())){
                                        ModelContenuPanier::ajouterProduit([
                                            "idProduit" => $produit->get("idproduit"),
                                            "quantite" => $line["quantite"],
                                            "idUtilisateur" => Session::getIdUtilisateur()
                                        ]);
                                    }
                                    else{
                                        (new ModelContenuPanier([
                                            "idProduit" => $produit->get("idproduit"),
                                            "quantite" => $line["quantite"],
                                            "idPanier" => ModelUtilisateur::selectIdPanier(Session::getIdUtilisateur())
                                        ]))->save(Session::getIdUtilisateur());
                                    }
                                }
                            }
                            header("Location: ?controller=produit&action=readAll");
                       }
                       else{
                           header("Location: ?controller=utilisateur&action=messageConfirmation&idUtilisateur=".rawurlencode($userID));
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
            if(isset($_POST["adresseEmail"]) && isset($_POST["motDePasse"]) && isset($_POST["confirmationMotDePasse"]) && isset($_POST["prenom"]) && isset($_POST["nom"])){
                $prenom = $_POST["prenom"];
                $nom = $_POST["nom"];
                $adresseEmail = $_POST["adresseEmail"];
                $motDePasse = $_POST["motDePasse"];
                $motDePasseConfirmation = $_POST["confirmationMotDePasse"];

                if(!empty($prenom) && !empty($nom)){
                    if(filter_var($adresseEmail, FILTER_VALIDATE_EMAIL)){
                        if($motDePasse == $motDePasseConfirmation){
                            require_once File::build_path(["model","ModelUtilisateur.php"]);
                            if(!ModelUtilisateur::adresseEmailExists($adresseEmail)){
                                $motDePasse = Security::hacher($motDePasse);
                                $nonce = Security::generateRandomHex();
                                $user = new ModelUtilisateur([
                                    "adresseEmail" => $adresseEmail,
                                    "motDePasse" => $motDePasse,
                                    "nonce" => $nonce,
                                    "nom" => strtoupper($nom),
                                    "prenom" => ucfirst($prenom)
                                ]);
                                $user->save();
                                $userID = ModelUtilisateur::checkPassword($adresseEmail,$motDePasse);
                                require_once File::build_path(["lib","Mail.php"]);
                                if(Mail::sendConfirmationMail($adresseEmail,"https://webinfo.iutmontp.univ-montp2.fr/~goupilm/projet-e-Commerce-IUT/src/?controller=utilisateur&action=validate&idUtilisateur=".rawurlencode($userID)."&nonce=".rawurlencode($nonce))){
                                    header("Location: ?controller=utilisateur&action=messageConfirmation&idUtilisateur=".rawurlencode($userID));
                                }
                                else{
                                    echo "erreur";
                                }
                            }
                            else{
                                $errorEmail = "L'adresse email est d??j?? utilis??e par un utilisateur";
                            }

                        }
                        else{
                            $errorMotDePasse = "Le mot de passe de confirmation est diff??rent du mot de passe donn??";
                        }
                    }
                    else{
                        $errorEmail = "L'adresse email n'est pas valide";
                    }
                }
                else{
                    $errorNomPrenom = "Veuillez donner un nom et un pr??nom";
                }
            }
            else{
                if(!isset($_POST["adresseEmail"])){
                    $errorEmail = "Veuillez donner une adresse email";
                }

                if(!isset($_POST["motDePasse"])){
                    $errorMotDePasse = "Veuillez donner un mot de passe";
                }

                if(!isset($_POST["confirmationMotDePasse"])){
                    $errorMotDePasseConfirmation = "Veuillez donner un mot de passe de confirmation";
                }

                if(!isset($_POST["nom"]) || isset($_POST["prenom"])){
                    $errorNomPrenom = "Veuillez donner un nom et un pr??nom";
                }
                else{
                    if(empty($_POST["nom"]) || empty($_POST["prenom"])){
                        $errorNomPrenom = "Veuillez donner un nom et un pr??nom";
                    }
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
                $idUtilisateur = rawurldecode($_GET["idUtilisateur"]);
                $nonce = rawurldecode($_GET["nonce"]);
                require_once File::build_path(["model","ModelUtilisateur.php"]);
                if($nonce == ModelUtilisateur::getNonce($idUtilisateur)){
                    ModelUtilisateur::setNonceToNULL($idUtilisateur);
                    $view = "validate";
                    $titre = "Confirmation cr??ation de compte";
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
                if($user = ModelUtilisateur::select(rawurldecode($_GET["idUtilisateur"]))){
                    if($user->get("nonce") != ""){
                        $view = "messageConfirmation";
                        $titre = "Confirmation Email";
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

//    public static function profil() {
//        if (!Session::userIsCreate()) {
//
//        } else {
//            header("Location:");
//        }
//    }

//    public static function motDePasseOublie(){
//
//    }

    public static function deconnected(){
        if(Session::userIsCreate()){
            Session::destroyUser();
        }
        header("Location: ?controller=produit&action=readAll");
    }
}