<?php
    /**
     * Summary of rechercheRecettes
     * @author oier Cesat <ocesat@iutbayonne.univ-pau.fr>
     * @brief permet d'extrire toutes les recettes possibles grâce au stock de la soirée 
     * @param mixed $stockSoiree
     * @param mixed $recettesExistantes
     * @return array liste de recette possible grâce à notre stock
     */
    function rechercheRecettes($stockSoiree ,$recettesExistantes){

        // Initialisation des listes
        $recettesTemp = array();        //variable temporaire pour effectuer un deuxième tri dans une liste déjà triée une première fois 
        $recettesPossibles = array();   //liste de recette possible grâce à notre stock

        //Instanciation des variables taille
        $tailleStockSoireeAlcool=sizeof($stockSoiree->getLAlcools());
        $tailleStockSoireeDiluant = sizeof($stockSoiree->getLDiluants());
        $tailleRecettesExistantes = sizeof($recettesExistantes);

        //Premiere boucle permetant de recherche les recettes pouvant être réalisées grâce au stock d'alcool
        for ($i=0; $i <$tailleStockSoireeAlcool ; $i++) { 
                for ($j=0; $j < $tailleRecettesExistantes; $j++) {
                    if ($stockSoiree->getLAlcools()[$i]->getNomBoisson()==$recettesExistantes[$j]->getAlcool()) {
                        array_push($recettesTemp, $recettesExistantes[$j]);
                    }
                }
            }

        //Instanciation de la taille de recettesTemp
        $tailleRecettesTemp = sizeof($recettesTemp);

        //Deuxième boucle permetant de recherche les recettes pouvant être réalisées grâce au stock de diluant 
        for ($i=0; $i <$tailleStockSoireeDiluant ; $i++) { 
            for ($j=0; $j < $tailleRecettesTemp; $j++) {
                if ($stockSoiree->getLDiluants()[$i]->getNomBoisson()==rtrim( $recettesTemp[$j]->getDiluant())) {
                    array_push($recettesPossibles, $recettesTemp[$j]);
                }
            }
        }
    return $recettesPossibles;
    };
