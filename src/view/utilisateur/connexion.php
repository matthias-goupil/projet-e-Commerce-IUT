<main>
    <form method="POST" action="?controller=utilisateur&action=connected">
        <h2><?php echo $titre?></h2>
        <div>
            <label for="email">Adresse Email</label>
            <input id="email" type="email" name="adresseEmail" placeholder="AdresseEmail">
            <?php
            if(isset($errorEmail)){
                ?><p class="error"><?php echo $errorEmail?></p><?php
            }
            ?>
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="motDePasse" placeholder="Mot de passe">
            <?php
            if(isset($errorMotDePasse)){
                ?><p class="error"><?php echo $errorMotDePasse?></p><?php
            }
            ?>
        </div>

        <p>Pas encore inscrit ? <a href="?controller=utilisateur&action=inscription">S'inscrire</a></p>
        <input type="submit" value="Se connecter">
    </form>
</main>