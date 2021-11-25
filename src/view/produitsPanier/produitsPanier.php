<?php
foreach ($tabProduitsPanier as $p) {
    echo '<a href="#">
            <div class ="produitsPanier">
                <img src="'.htmlspecialchars($p['produit']->get('urlImage1')).'">
                <p>'. htmlspecialchars($p['produit']->get('intitule')).'</p>
                
                <p><a href="?controller=produitsPanier&action=ajouter">+</a>  '. htmlspecialchars($p['produitsPanier']->get('quantite')).'  <a href="?controller=produitsPanier&action=ajouter">-</a></p>
                
                <p>'. htmlspecialchars(($p['produit']->get('prix'))*$p['produitsPanier']->get('quantite')).'</p>
            </div>
          </a>';
}