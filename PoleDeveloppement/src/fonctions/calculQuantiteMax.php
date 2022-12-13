<?php
require_once('Stock.php');

function calculQuantiteMax ($stockSoiree) {
    $qtMax = 0;

    foreach ($stockSoiree->getLAlcools() as $value) { //Pour chaque élément de la liste d'alcools de notre stock
        $quantite = $value->getQtBoissonInitiale(); //on récupère sa quantité initiale 
        $qtMax = $qtMax + $quantite; //on l'ajoute à la variable qtMax 
    }

    foreach ($stockSoiree->getLDiluants() as $value) { //Pour chaque élément de la liste de diluants de notre stock
        $quantite = $value->getQtBoissonInitiale(); //on récupère sa quantité initiale 
        $qtMax = $qtMax + $quantite; //on l'ajoute à la variable qtMax
    }

    return $qtMax;
   }
   
?>