<?php
foreach ($tabProduitsPanier as $p) {
    echo '<a href="#" class ="produitsPanier">
                   <p>'. htmlspecialchars($p['produit']->get('intitule')).'</p>
                   <img src="'.htmlspecialchars($p['produit']->get('urlImage1')).'">
          </a>';
}