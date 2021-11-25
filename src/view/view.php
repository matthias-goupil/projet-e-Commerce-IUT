<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre ?></title>
    <link rel="stylesheet" href="public/css/styles.css">
    <link rel="stylesheet" href="public/css/<?php echo self::$objet."/".$view.".css"?>">

    <!--Roboto-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Bottle Trick-Shop</h1>
        <nav>
            <ul>
                <li><a href="#">Produits</a></li>
                <li><a href="#">Connexion</a></li>
                <li><a href="#">Incription</a></li>
                <li><a href="#">Panier</a></li>
            </ul>
        </nav>
    </header>

    <body>
    <?php require_once File::build_path(["view",self::$objet,$view.".php"])?>

    </body>

    <footer>
        <p>Bottle Trick-shop | Tout droit réservé</p>
    </footer>
</body>
</html>