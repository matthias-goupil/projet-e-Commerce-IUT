<main>
<?php
        foreach($tabCommandes as $commande) {
            ?>
            <div class="commande">
                    <?php 
                        $np = rawurlencode($commande->get("prenom") . ' ' .  $commande->get("nom"));
                        echo  ' <p> Nom : ' . htmlspecialchars($commande->get("nom")) .'</p>' .
                        ' <p> Prenom : ' . htmlspecialchars($commande->get("prenom")) .'</p>' .
                        ' <p> Adresse : ' . htmlspecialchars($commande->get("adresseLivraison")) .'</p>' .
                        ' <p> Ville : ' . htmlspecialchars($commande->get("villeLivraison")) .'</p>' .
                        ' <p> Code Postal : ' . htmlspecialchars($commande->get("codePostalLivraison")) .'</p>' .
                        ' <p> Telephone : ' . htmlspecialchars($commande->get("numeroTelephone")) .'</p>' .
                        ' <p> Date Commande : ' . htmlspecialchars($commande->get("dateCommande")) .'</p>' .
                        ' <p> Date Livraison : ' . htmlspecialchars($commande->get("dateLivraison")) .'</p>' .
                        ' <p><a href="?controller=contenuPanier&action=readAll&nom='. $np . '&idPanier='.  rawurlencode($commande->get("idPanier")) .'"><button class="bouton"> Voir le panier </button></a></p>'; ?>
                </div>
           
            </div>

            
    
    <?php  }
        ?>
</main>