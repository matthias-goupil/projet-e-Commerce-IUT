<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $titre ?></title>
</head>
<body>
    <header>
        <h1>Bottle Trick-Shop</h1>
        <nav>
            <ul>
                <li><a href="?controller=produit&action=read">Detailproduit</a></li>
                <li><a href="#">Produits</a></li>
                <li><a href="#">Connexion</a></li>
                <li><a href="#">Incription</a></li>
                <li><a href="#">Panier</a></li>
            </ul>
        </nav>
    </header>

    <?php require_once File::build_path(["view",self::$objet,$view.".php"])?>

    <footer>
        <p>Bottle Trick-shop | Tout droit réservé</p>
    </footer>
</body>
</html>