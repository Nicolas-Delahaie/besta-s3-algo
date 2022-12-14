<?php 
/**
 * Summary of calculQuantiteDesRecettes
 * @brief calcule la quantité maximale de recette que l'on peut faire à partir de la quantité de boisson que l'on a
 * @param array recettePossible valeursARetourner d'objets de type Recette
 * @param int $DOSE_ALCOOL constante représentant la quantité d'alcool par verre
 * @param int $DOSE_DILUANT constante représentant la quantité de diluant par verre
 * @param stock $stockSoiree stock de boisson contenant des valeursARetourner d'alcool, de diluants et autre
 * @param int $tailleStockSoireeAlcool taille de la valeursARetourner du stock d'alcool
 * @param int $tailleStockSoireeDiluant taille de la valeursARetourner du stock de diluant
 * @param int $tailleRecettesPossibles taille de la valeursARetourner contenant les recettes possibles
 * @return array $valeursARetourner contient le resultat de calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool,$tailleStockSoireeDiluant) et de chaque recettespossibles trouvées grâce à calculQuantiteRecette($recettesPossibles[$i],$DOSE_ALCOOL,$DOSE_DILUANT)
 */
function calculQuantiteDesRecettes($recettesPossibles,$DOSE_ALCOOL,$DOSE_DILUANT,$stockSoiree, $tailleStockSoireeAlcool,$tailleStockSoireeDiluant,$tailleRecettesPossibles){
    
    $valeursARetourner = array(); //On créer l'array qui contiendra les deux résultats de nos deux fonctions 

    $qtMax = calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool,$tailleStockSoireeDiluant); //$qtMax prend la valeur du résultat de la fonction calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool,$tailleStockSoireeDiluant)

    array_push($valeursARetourner, $qtMax); //On ajoute $qtMax à l'array
    

    for ($i=0; $i < $tailleRecettesPossibles ; $i++) { //On parcours jusqu'à qu'il n'y ai plus de recettesPossibles
        $qtRecette = calculQuantiteRecette($recettesPossibles[$i],$DOSE_ALCOOL,$DOSE_DILUANT); //$qtRecette prend la valeur de la fonction calculQuantiteRecette($recettesPossibles[$i],$DOSE_ALCOOL,$DOSE_DILUANT)

        array_push($valeursARetourner,$qtRecette); //On ajoute chaque itération dans l'array
    }

    return $valeursARetourner; //On retourne l'array contenant 
}

?>