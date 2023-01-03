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
            if ($recettesPossibles[$j]->getQtRecette() > $recettesPossibles[$j+1]->getQtRecette())
            {
                #Echange des recettes
                $temp = $recettesPossibles[$j];
                $recettesPossibles[$j] = $recettesPossibles[$j+1];
                $recettePossibles[$j+1] = $temp;
            }
        }
    }

    // -- Attribuer les valeurs --
    //Premiere valeur
    $valeur = $tailleRecettesPossibles;
    $recettesPossibles[0]->setValeur($valeur);

    //Autres valeurs
    for ($i=1; $i < $tailleRecettesPossibles-1; $i++) { 
        $volumeRecette = $recettesPossibles[$i]->getQtRecette();
        $volumeRecettePrecedente = $recettesPossibles[$i-1]->getQtRecette();
        if ($volumeRecette == $volumeRecettePrecedente)
        {
            //Recette aussi volumineuse
            $recettesPossibles[$i]->setValeur($valeur);
        }
        else
        {
            //Recette moins volumineuse, incrementation de valeur
            $valeur -= 1;
            $recettesPossibles[$i]->setValeur($valeur);
        }
    }
}

?>