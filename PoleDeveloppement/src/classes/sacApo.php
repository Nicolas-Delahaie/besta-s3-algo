<?php
    include("./../classes/Recette.php");
    include("./../classes/Branche.php");

    include("calculQuantiteRecette.php");

    function sacApo($recettesPossibles,$tailleRecettesPossibles,$qtMax,$doseAlcool,$doseDiluant){

    $meilleureCombinaison = new Branche;
    $borneInf = 0;
    $estFini = false;
    $brancheExplore =false;
    $brancheValide = array();
    $tailleBrancheValide = 0;
    $brancheInvalide = array();
    $tailleBrancheInvalide = 0;


    while ($estFini) {
        $iterateurRecette = 0;
        $recettesPossibles[$iterateurRecette] -> getAlcool() -> setQtBoissonEnCours($recettesPossibles[$iterateurRecette] -> getAlcool() -> getQtBoissonInitial());
        $recettesPossibles[$iterateurRecette]->getDiluant()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getDiluant()->getQtBoissonInitial());

        while (true) {
            
            $brancheEnCours = new Branche();
            $brancheEnCours->ajouterRecette($recettesPossibles[$iterateurRecette]);
    
            $tailleBrancheInvalide = sizeof($brancheInvalide);
    
            for ($i=0; $i <$tailleBrancheInvalide ; $i++) { 
                if ($brancheEnCours->getPRecette() == $brancheValide[$i]->getPRecette()) {
                    $brancheEnCours->popRecette();
                }
            }
    
            for ($i=0; $i < $tailleBrancheInvalide ; $i++) { 
                if ($brancheEnCours->getPRecette() == $brancheInvalide[$i]->getPRecette()) {
                    if ($brancheEnCours->estVide()) {
                        $estFini = true;
                    }
                    else{
                        $brancheEnCours->popRecette();
                    }
                }
            }
    
            $borneSup = 0;
            for ($i=$iterateurRecette; $i <$tailleRecettesPossibles ; $i++) { 
                $borneSup+= $recettesPossibles[$i]->getValeurRecette();
            }
    
            $borneSup += $brancheEnCours->getQtValeur();
            
            if ($brancheEnCours->getQtBranche() > $borneInf) {
                $borneInf = $brancheEnCours->getQtBranche();
            }
    
            if ($brancheEnCours->getQtBranche() > $qtMax || $brancheEnCours->getQtValeur() < $borneInf) {
                array_push($brancheInvalide, $brancheEnCours);
                break;
    
            }

            $recettesPossibles[$iterateurRecette]->getAlcool()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getAlcool()->getQtBoissonEnCours() - $recettesPossibles[$iterateurRecette]->getAlcool());
            $recettesPossibles[$iterateurRecette]->getDiluant()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getDiluant()->getQtBoissonEnCours() - $recettesPossibles[$iterateurRecette]->getDiluant());

            for ($i=0; $i < $tailleRecettesPossibles ; $i++) { 
                if ($recettesPossibles[$iterateurRecette]->getAlcool()==$recettesPossibles[$i]->getAlcool()) {
                    calculQuantiteRecette($recettesPossibles[$i],$doseAlcool,$doseDiluant);
                }
                if ($recettesPossibles[$iterateurRecette]->getDiluant()==$recettesPossibles[$i]->getDiluant()) {
                    calculQuantiteRecette($recettesPossibles[$i],$doseAlcool,$doseDiluant);
                }
            }
            if ($iterateurRecette == $tailleRecettesPossibles-1) {
                array_push($brancheValide, $brancheEnCours);
                break;
            }
            else{
                $iterateurRecette++;
            }
        }
    }

    for ($i=0; $i < $tailleBrancheValide ; $i++) { 
        if ($borneInf == $brancheValide[$i]->getQtValeur()) {
            $meilleureCombinaison = $brancheValide[$i];
        }
    }

    return $meilleureCombinaison;
    }
