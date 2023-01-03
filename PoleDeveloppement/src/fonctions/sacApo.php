<?php

// echo "La meilleure combinaison est : " . $meilleureCombinaison->toString() . "<br>";
/**
 * Summary of sacApo
 * @param array $recettesPossibles liste de recette possible grâce à notre stock
 * @param int $tailleRecettesPossibles taille de la liste recettePossible
 * @param int $qtMax quantité maximale calculée en fonction du stock en litres
 * @param int $doseAlcool une dose d’alcool
 * @param int $doseDiluant une dose de diluant
 * @return Branche $meilleureCombinaison objet Branche de la meilleure combinaison possible de recette grâce au stock de la soirée
 */
function sacApo($recettesPossibles, $tailleRecettesPossibles, $qtMax, $doseAlcool, $doseDiluant)
{

    /* -------------------- declaration des variables locales ------------------- */

    $meilleureCombinaison = new Branche;
    $brancheValide = array();
    $brancheInvalide = array();

    /* ----------------------------- initialisation ----------------------------- */

    $borneInf = 0;
    $estFini = false;
    $tailleBrancheValide = 0;
    $tailleBrancheInvalide = 0;

    /* ----------------------------- traitement ----------------------------- */

    /* -------------- Explorer toutes les possibilites de recettes -------------- */

    while (!($estFini)) {

        $iterateurRecette = 0;

        //Initialisation de la quantite en cours
        $recettesPossibles[$iterateurRecette]->getAlcool()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getAlcool()->getQtBoissonInitiale());
        $recettesPossibles[$iterateurRecette]->getDiluant()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getDiluant()->getQtBoissonInitiale());

        //Initialisation de la branche en cours
        $brancheEnCours = new Branche();
        
        //Parcours et recherche des branches valide
        while (true) {
            
            //Ajout de la recette en cours a la branche en cours
            $brancheEnCours->ajouterRecette($recettesPossibles[$iterateurRecette]);
            
            //initialisation de la taille de la branche invalide 
            $tailleBrancheInvalide = sizeof($brancheInvalide);
            
            //initialisation de la taille de la branche valide
            $tailleBrancheValide = sizeof($brancheValide);
            
            //Verification si la brancheEnCours est dans brancheValide
            for ($i = 0; $i < $tailleBrancheValide; $i++) {
                if ($brancheEnCours->getPRecette() == $brancheValide[$i]->getPRecette()) {
                    $brancheEnCours->popRecette();
                }
            }
            
            /* ------- Verification si la brancheEnCours est dans brancheInvalide ------- */
            
            for ($i = 0; $i < $tailleBrancheInvalide; $i++) {
                if ($brancheEnCours->getPRecette() == $brancheInvalide[$i]->getPRecette()) {
                    
                    //si en plus la branche en vide alors on arrete
                    if ($brancheEnCours->estVide()) {
                        $estFini = true;
                        break;
                    }
                    
                    //sinon on supprime la recette en cours de la branche en cours
                    else {
                        $brancheEnCours->popRecette();
                    }
                }
            }
            
            /* ------------------------ Mis à jour des variables ------------------------ */
            
            //Mise à jour de la borne sup
            $borneSup = 0;
            
            //Parcours des recettes possibles encore ajoutable
            for ($i = $iterateurRecette+1; $i < $tailleRecettesPossibles; $i++) {
                $borneSup += $recettesPossibles[$i]->getValeur();
            }
            
            //Ajout de la valeur de la branche en cours a la borne sup
            $borneSup += $brancheEnCours->getQtValeur();            
            
            //Mise à jour de la borne inf
            if ($brancheEnCours->getQtBranche() > $borneInf) {
                $borneInf = $brancheEnCours->getQtValeur();
            }

            /* --------------- Verification si brancheEnCours est invalide -------------- */
            
            if ($brancheEnCours->getQtBranche() > $qtMax || $brancheEnCours->getQtValeur() < $borneInf) {
                array_push($brancheInvalide, $brancheEnCours);
                break;
            }
            
            /* ------------------------- Mis à jour des varibles ------------------------ */
            
            //Mise à jour de la quantité des boissons

            $recettesPossibles[$iterateurRecette]->getAlcool()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getAlcool()->getQtBoissonEnCours() - $recettesPossibles[$iterateurRecette]->getQtAlcool());
            $recettesPossibles[$iterateurRecette]->getDiluant()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getDiluant()->getQtBoissonEnCours() - $recettesPossibles[$iterateurRecette]->getQtDiluant());
            
            //Mise à jour de la quantité des boissons dans recette
            for ($i = 0; $i < $tailleRecettesPossibles; $i++) {
                if ($recettesPossibles[$iterateurRecette]->getAlcool() == $recettesPossibles[$i]->getAlcool()) {
                    calculQuantiteRecette($recettesPossibles[$i], $doseAlcool, $doseDiluant);
                }
                if ($recettesPossibles[$iterateurRecette]->getDiluant() == $recettesPossibles[$i]->getDiluant()) {
                    calculQuantiteRecette($recettesPossibles[$i], $doseAlcool, $doseDiluant);
                }
            }

            /* ---------- Verification si toute les recettes ont été parcourus ---------- */

            //si oui on ajoute la branche en cours a brancheValide
            if ($iterateurRecette == $tailleRecettesPossibles - 1) {
                array_push($brancheValide, $brancheEnCours);
                break;
            }

            //sinon on passe a la recette suivante
            else {
                $iterateurRecette++;
            }
        }
    }

    /* --------------------- Trouver la meilleur possibilité -------------------- */

    //Parcourss de toutes les branches valide
    for ($i = 0; $i < $tailleBrancheValide; $i++) {
        if ($borneInf == $brancheValide[$i]->getQtValeur()) {
            $meilleureCombinaison = $brancheValide[$i];
        }
    }

    /* ----------------------------- return ----------------------------- */
    return $meilleureCombinaison;
}
