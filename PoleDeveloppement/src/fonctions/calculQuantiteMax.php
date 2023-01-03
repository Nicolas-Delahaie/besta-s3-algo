<?php
 * @brief calcule la quantité totale d'alcool et de diluant que l'on a en stock (pas autre)
 * @param Stock $stockSoiree contient toutes les listes de boissons
 * @param int $tailleStockSoireeAlcool taille de la liste d'alcool du stock $stockSoiree
 * @param int $tailleStockSoireeDiluant taille de la liste de diluants du stock $stockSoiree
 * @return int $qtMax la quantité totale d'alcool et de diluant que l'on a en stock (pas autre)
 */
function calculQuantiteMax ($stockSoiree,$tailleStockSoireeAlcool,$tailleStockSoireeDiluant) {
    $qtMax = 0;

    for ($i=0; $i < $tailleStockSoireeAlcool; $i++) { 
        $alcool = $stockSoiree->getLAlcools()[$i]; //Pour chaque élément de la liste d'alcools de notre stock
        $quantite = $alcool->getQtBoissonInitiale();//on récupère sa quantité initiale
        $qtMax = $qtMax + $quantite;//on l'ajoute à la variable qtMax 

    }

    for ($i=0; $i < $tailleStockSoireeDiluant; $i++) { 
        $diluant = $stockSoiree->getLDiluants()[$i];  //Pour chaque élément de la liste de diluants de notre stock
        $quantite = $diluant->getQtBoissonInitiale(); //on récupère sa quantité initiale 
        $qtMax = $qtMax + $quantite; //on l'ajoute à la variable qtMax
    }

    return $qtMax;

}
?>

