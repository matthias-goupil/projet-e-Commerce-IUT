<main>
    <div class="background">
        <h1>Connexion</h1>
        <form action="?controller=utilisateur&action=connected" method="GET">
            <label for="input_mail">Adresse email</label>
            <input type="text" name="adresseEmail" id="input_mail" placeholder="Ex : francisbernard@gmail.com">
            <?php
            if(isset($errorEmail) && $errorEmail){
                ?>
                <p class="error">Erreur: Pas d'adresse Email de donné</p>
                <?php
            }
            ?>
            <label for="input_password">Mot de passe</label>
            <input type="text" name="motDePasse" id="input_password">
            <?php
            if(isset($errorMotDepasse) && $errorMotDepasse){
                ?>
                <p class="error">Erreur: Pas de mot de passe de donné</p>
            <?php
            }
            ?>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</main>