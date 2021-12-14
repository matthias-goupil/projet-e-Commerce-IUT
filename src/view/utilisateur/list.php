<main>
    <h1>Liste des utilisateurs</h1>
    <?php
        foreach ($tabUtilisateurs as $user){
            ?>
            <div class="utilisateur">
                <p class="nom"><?php echo htmlspecialchars($user->get("nom"))?></p>
                <p class="prenom"><?php echo htmlspecialchars($user->get("prenom"))?></p>
                <p class="adresseEmail"><?php echo htmlspecialchars($user->get("adresseEmail"))?></p>
                <p class="role"><?php echo htmlspecialchars($user->get("role"))?></p>
                <p class="role"><?php echo ($user->get("nonce") == "")?"Inscrit":"En attende de validation"?></p>
            </div>
            <?php
        }
    ?>
</main>
