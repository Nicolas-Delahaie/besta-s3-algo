<?php 
/**
 * Summary of calculQuantiteRecette
 * @brief calcule la quantité maximale de recette que l'on peut faire à partir de la quantité de boisson que l'on a
 * @param Recette recette objet Recette qui représente un alcool associé à un diluant, la quantité de chacun, la quantité totale et la valeur de la recette
 * @param int $DOSE_ALCOOL constante représentant la quantité d'alcool par verre
 * @param int $DOSE_DILUANT constante représentant la quantité de diluant par verre
 * @return Recette recette objet Recette qui représente un alcool associé à un diluant, la quantité de chacun, la quantité totale et la valeur de la recette
 */
function calculQuantiteRecette($recette, $DOSE_ALCOOL, $DOSE_DILUANT){
    
    $nbDoseAlcool = $recette->getAlcool()->getQtBoissonEnCours() / $DOSE_ALCOOL; //Calcul du nombre de doses d'alcool possible par rapport à la quantité d'alcool disponible
    
    $nbDoseDiluant = $recette->getDiluant()->getQtBoissonEnCours() / $DOSE_DILUANT; //Calcul du nombre de doses de diluant possible par rapport à la quantité de diluant disponible

    if($nbDoseAlcool == 0 || $nbDoseDiluant == 0){ //Si il n'y a pas de doses d'alcool ou de diluant, on ne peut pas faire de recette
        return $recette; //On retourne l'objet recettePossible
    }

    if ($nbDoseAlcool <= $nbDoseDiluant){ //Compare les 2 nombres de le doses et si il y a plus de doses de diluant que d'alcool; le limitant est l'alcool
        $qtDiluant = $nbDoseAlcool * $DOSE_DILUANT; //On calcule la quantité de diluant que l'on va avoir en fonction du nombre de doses maximale (nombre de doses d'alcool)

        $qtAlcool = $nbDoseAlcool * $DOSE_ALCOOL; //On calcule la quantité d'alcool que l'on va avoir en fonction du nombre de doses maximale (nombre de doses d'alcool)

        $recette->setQtRecette($qtAlcool + $qtDiluant); //On remplace la quantité de recette possible actuelle par la quantité totale (diluant + alcool)

        $recette->setQtAlcool($qtAlcool); //On remplace la quantité d'alcool actuelle par le résultat de qtAlcool

        $recette->setQtDiluant($qtDiluant); //On remplace la quantité de diluant actuelle par le résultat de qtDiluant
    }
    
    else { //le limitant est le diluant
        $qtDiluant = $nbDoseDiluant * $DOSE_DILUANT; //On calcule la quantité de diluant que l'on va avoir en fonction du nombre de doses maximale (nombre de doses de diluant)

        $qtAlcool = $nbDoseDiluant * $DOSE_ALCOOL; //On calcule la quantité d'alcool que l'on va avoir en fonction du nombre de doses maximale (nombre de doses de diluant)

        $recette->setQtRecette($qtAlcool + $qtDiluant);  //On remplace la quantité de recette possible actuelle par la quantité totale (diluant + alcool)

        $recette->setQtAlcool($qtAlcool); //On remplace la quantité d'alcool actuelle par le résultat de qtAlcool

        $recette->setQtDiluant($qtDiluant); //On remplace la quantité de diluant actuelle par le résultat de qtDiluant
    }

    return $recette;
}

?>