<?php
/**
 * @author Nicolas D.
 * @file calculDesValeurs.php
 */

/**
 * @brief Attribue les valeurs a chaque recettes possibles
 * @param Array recettesPossibles Liste des recettes possibles en fonction des boissons restantes
 * @return Array Liste des recettes possibles, completées avec leur valeur respective
 */
function calculDesValeurs($recettesPossibles)
{
    // -- Trier les recettes --
    $tailleRecettesPossibles = count($recettesPossibles);
    for ($i=0; $i < $tailleRecettesPossibles; $i++) { 
        for ($j=0; $j < $i; $j++) { 
            if ($recettePossibles[$j].getQtRecette() > $recettesPossibles[$j+1].getQtRecette()){
                #Echange des recettes
                $temp = $recettePossibles[$j];
                $recettePossibles[$j] = $recettePossibles[$j+1];
                $recettePossibles[$j+1] = $temp;
            }
        }
    }

    // -- Attribuer les valeurs --
    //Premiere valeur
    $valeur = $tailleRecettesPossibles;
    $recettesPossibles[0].setValeur(valeur);

    //Autres valeurs
    for ($i=0; $i < $tailleRecettesPossibles; $i++) { 
        if ($recettesPossibles[i].getQtRecette() == $recettesPossibles[i-1].getQtRecette()){
            $recettesPossibles[i].setValeur($valeur);
        }
        else
        {
            $valeur += 1;
            $recettesPossibles[i].setValeur($valeur);
        }
    }
}

?>