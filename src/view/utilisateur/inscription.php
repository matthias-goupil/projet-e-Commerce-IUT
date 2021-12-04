<main>
    <form method="POST" action="?controller=utilisateur&action=create">
        <h2><?php echo $titre?></h2>
        <div>
            <label for="email">Adresse Email</label>
            <input id="email" type="email" name="adresseEmail" placeholder="AdresseEmail">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="motDePasse" placeholder="Mot de passe">
        </div>

        <div>
            <label for="confirmationPassword">Confirmation du Mot de passe</label>
            <input id="confirmationPassword" type="password" name="confirmationMotDePasse" placeholder="Confirmation du mot de passe">
        </div>

        <input type="submit" value="S'inscrire">
    </form>
</main>