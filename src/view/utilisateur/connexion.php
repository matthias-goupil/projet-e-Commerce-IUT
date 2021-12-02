<main>
    <div class="background">
        <h1>Connexion</h1>
        <form action="?controller=utilisateur&action=connected" method="GET">
            <label for="input_mail">Adresse email</label>
            <input type="text" name="adresseEmail" id="input_mail">
            <p></p>
            <label for="input_password">Mot de passe</label>
            <input type="text" name="motDePasse" id="input_password">
            <p></p>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</main>