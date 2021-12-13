<main>
<?php
        foreach($tabCommandes as $commande) {
            ?>
            <div class="commande">
                    <?php 
                        $np = $commande->get("prenom") . ' ' .  $commande->get("nom");
                        echo  ' <p> Nom : ' . $commande->get("nom") .'</p>' . 
                        ' <p> Prenom : ' . $commande->get("prenom") .'</p>' .
                        ' <p> Adresse : ' . $commande->get("adresseLivraison") .'</p>' .
                        ' <p> Ville : ' . $commande->get("villeLivraison") .'</p>' .
                        ' <p> Code Postal : ' . $commande->get("codePostalLivraison") .'</p>' .
                        ' <p> Telephone : ' . $commande->get("numeroTelephone") .'</p>' .
                        ' <p> Date Commande : ' . $commande->get("dateCommande") .'</p>' .
                        ' <p> Date Livraison : ' . $commande->get("dateLivraison") .'</p>' .
                        ' <p><a href="?controller=contenuPanier&action=readAll&nom='. $np . '&idPanier='.  $commande->get("idPanier") .'"><button class="bouton"> Voir le panier </button></a></p>'; ?>
                </div>
           
            </div>

            
    
    <?php  }
        ?>
</main>