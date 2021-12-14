<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($titre) ?></title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/<?php echo self::$objet."/".$view.".css"?>">

    <!--Roboto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <a href="?controller=produit&action=readAll"><h1>Bottle Trick-Shop</h1></a>
        <nav>
            <ul>

                <li><a href="?controller=produit&action=readAll"><img src="public/images/icons/bottle.svg"><p><?php echo (Session::userIsAdmin())?"Gestion des produits":"Nos produits";?></p></a></li>

                <?php
                    if(!Session::userIsAdmin()){
                        ?><li><a href="?controller=contenuPanier&action=readAll"><img src="public/images/icons/cart.svg"><p>Votre panier</p></a></li>
                        <li><a href="?controller=commande&action=readAll"><img src="public/images/icons/commande.svg"><p>Vos commandes</p></a></li><?php
                    }
                    else{
                        ?><li><a href="?controller=utilisateur&action=readAll"><img src="public/images/icons/login.svg"><p>Gestion des utlisateurs</p></a></li>
                        <li><a href="?controller=commande&action=readAll"><img src="public/images/icons/commande.svg"><p>Gestion des commandes</p></a></li><?php
                    }
                    if(Session::userIsCreate()){
                        ?>
                        <li><a href="?controller=utilisateur&action=deconnected"><img src="public/images/icons/logout.svg"><p>Déconnexion</p></a></li>
                        <?php
                    }
                    else{
                        ?>
                        <li><a href="?controller=utilisateur&action=connexion"><img src="public/images/icons/login.svg"><p>Connexion</p></a></li>
                        <?php
                    }
                ?>
            </ul>
        </nav>
    </header>    
        <?php require_once File::build_path(["view",self::$objet,$view.".php"])?>
    <footer>
        <p>Bottle Trick-shop | Tout droit réservé</p>
    </footer>
</body>
</html>