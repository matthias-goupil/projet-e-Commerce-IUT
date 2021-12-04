<main>
    <form method="POST" action="?controller=utilisateur&action=create">
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

        <div>
            <label for="confirmationPassword">Confirmation du Mot de passe</label>
            <input id="confirmationPassword" type="password" name="confirmationMotDePasse" placeholder="Confirmation du mot de passe">
            <?php
                if(isset($errorMotDePasseConfirmation)){
                    ?><p class="error"><?php echo $errorMotDePasseConfirmation?></p><?php
                }
            ?>
        </div>

        <input type="submit" value="S'inscrire">
    </form>
</main>