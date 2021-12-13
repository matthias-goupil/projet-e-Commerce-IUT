<main>
    <?php
        if(Session::userIsCreate()){
            $date = new DateTime();
            $date->modify("+7 day");

            ?>
            <h1>Votre commande est en route, elle vous sera livré pour le <?php echo $date->format("d/m/y")?></h1>
            <p>Merci d'avoir choisis les bouteilles Bottle Trick-Shop pour réaliser vos meilleurs tricks !</p>


            <a href="?controller=Produit&action=readAll">Continuer vos achats</a>
            <?php
        }
        else{
            ?>
            <h1>Veuillez vous connecter ou vous inscrire pour commander ce panier</h1>

            <?php
        }
    ?>

</main>
