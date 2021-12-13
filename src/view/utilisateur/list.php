<main>
    <h1>Liste des utilisateurs</h1>
    <?php
        foreach ($tabUtilisateurs as $user){
            ?>
            <div class="utilisateur">
                <p class="nom"><?php echo $user->get("nom")?></p>
                <p class="prenom"><?php echo $user->get("prenom")?></p>
                <p class="adresseEmail"><?php echo $user->get("adresseEmail")?></p>
                <p class="role"><?php echo $user->get("role")?></p>
                <p class="role"><?php echo ($user->get("nonce") == "")?"Inscrit":"En attende de validation"?></p>
            </div>
            <?php
        }
    ?>
</main>
