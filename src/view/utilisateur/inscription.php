<main>
    <form method="POST" action="?controller=utilisateur&action=create">
        <h2><?php echo htmlspecialchars($titre)?></h2>
        <div id="prenomNom">
            <div>
                <label>Prénom</label>
                <input type="text" name="prenom" placeholder="Prénom" value="<?php echo (isset($_POST["prenom"]))?$_POST["prenom"]:"";?>" required>
            </div>
            <div>
                <label>Nom</label>
                <input type="text" name="nom" placeholder="Nom" value="<?php echo (isset($_POST["nom"]))?$_POST["nom"]:"";?>"  required>
            </div>
        </div>
        <?php
        if(isset($errorNomPrenom)){
            ?><p class="error"><?php echo htmlspecialchars($errorNomPrenom)?></p><?php
        }
        ?>

        <div>
            <label for="email">Adresse Email</label>
            <input id="email" type="email" name="adresseEmail" placeholder="AdresseEmail" value="<?php echo (isset($_POST["adresseEmail"]))?$_POST["adresseEmail"]:"";?>" required>
            <?php
                if(isset($errorEmail)){
                    ?><p class="error"><?php echo htmlspecialchars($errorEmail)?></p><?php
                }
            ?>
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="motDePasse" placeholder="Mot de passe" required>
            <?php
                if(isset($errorMotDePasse)){
                    ?><p class="error"><?php echo htmlspecialchars($errorMotDePasse)?></p><?php
                }
            ?>
        </div>

        <div>
            <label for="confirmationPassword">Confirmation du Mot de passe</label>
            <input id="confirmationPassword" type="password" name="confirmationMotDePasse" placeholder="Confirmation du mot de passe" required>
            <?php
                if(isset($errorMotDePasseConfirmation)){
                    ?><p class="error"><?php echo htmlspecialchars($errorMotDePasseConfirmation)?></p><?php
                }
            ?>
        </div>

        <p>Déjà inscrit ? <a id="boutonConnexion" href="?controller=utilisateur&action=connexion">Se connecter</a></p>

        <input type="submit" value="S'inscrire">
    </form>
</main>