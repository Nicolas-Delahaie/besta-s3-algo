<?php

/**
 * @author Nicolas D.
 * @brief Attribue les valeurs a chaque recettes possibles
 * @param array recettesPossibles Liste des recettes possibles en fonction des boissons restantes
 * @return array Liste des recettes possibles, completées avec leur valeur respective
 */
function calculDesValeurs($recettesPossibles)
{
    // -- Trier les recettes --
    $tailleRecettesPossibles = count($recettesPossibles);
    for ($i = 0; $i < $tailleRecettesPossibles; $i++) {
        for ($j = 0; $j < $tailleRecettesPossibles - (1 + $i); $j++) {
            if ($recettesPossibles[$j]->getAlcool()->getQtBoissonInitiale() > $recettesPossibles[$j + 1]->getAlcool()->getQtBoissonInitiale()) {
                #Echange des recettes
                $temp = $recettesPossibles[$j];
                $recettesPossibles[$j] = $recettesPossibles[$j + 1];
                $recettesPossibles[$j + 1] = $temp;
            }
        }
    }

    // -- Attribuer les valeurs --
    //Premiere valeur
    $valeur = $tailleRecettesPossibles;
    $recettesPossibles[0]->setValeur($valeur);

    //Autres valeurs
    for ($i = 1; $i < $tailleRecettesPossibles; $i++) {
        $volumeAlcool = $recettesPossibles[$i]->getAlcool()->getQtBoissonInitiale();
        $volumeAlcoolPrecedente = $recettesPossibles[$i - 1]->getAlcool()->getQtBoissonInitiale();
        if ($volumeAlcool == $volumeAlcoolPrecedente) {
            //Recette aussi volumineuse
            $recettesPossibles[$i]->setValeur($valeur);
        } else {
            $valeur -= 1;
            $recettesPossibles[$i]->setValeur($valeur);
        }
    }
    return $recettesPossibles;
}

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
 * @return array $valeursARetourner contient le resultat de calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool,$tailleStockSoireeDiluant) et de chaque recettes possibles trouvées grâce à calculQuantiteRecette($recettesPossibles[$i],$DOSE_ALCOOL,$DOSE_DILUANT)
 */
function calculQuantiteDesRecettes($recettesPossibles, $DOSE_ALCOOL, $DOSE_DILUANT, $stockSoiree, $tailleStockSoireeAlcool, $tailleStockSoireeDiluant, $tailleRecettesPossibles)
{

    $valeursARetourner = array(); //On créer l'array qui contiendra les deux résultats de nos deux fonctions 
    $newRecettesPossibles = array(); //On créer l'array qui contiendra les recettes possibles

    $qtMax = calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool, $tailleStockSoireeDiluant); //$qtMax prend la valeur du résultat de la fonction calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool,$tailleStockSoireeDiluant)

    array_push($valeursARetourner, $qtMax); //On ajoute $qtMax à l'array


    for ($i = 0; $i < $tailleRecettesPossibles; $i++) { //On parcours jusqu'à qu'il n'y ai plus de recettesPossibles
        $recette = calculQuantiteRecette($recettesPossibles[$i], $DOSE_ALCOOL, $DOSE_DILUANT); //on calcule la quantité de chaque recette possible
        array_push($newRecettesPossibles, $recette); //On ajoute chaque itération dans l'array
    }

    array_push($valeursARetourner, $newRecettesPossibles); //On ajoute l'array contenant les recettes possibles à l'array contenant les résultats de nos deux fonctions ($qtMax et $recettesPossibles

    return $valeursARetourner; //On retourne l'array contenant les résultats de nos deux fonctions
}

/**
 * @brief calcule la quantité maximale de recette que l'on peut faire à partir de la quantité de boisson que l'on a
 * @param Recette recette objet Recette qui représente un alcool associé à un diluant, la quantité de chacun, la quantité totale et la valeur de la recette
 * @param int $DOSE_ALCOOL constante représentant la quantité d'alcool par verre
 * @param int $DOSE_DILUANT constante représentant la quantité de diluant par verre
 * @return Recette recette objet Recette qui représente un alcool associé à un diluant, la quantité de chacun, la quantité totale et la valeur de la recette
 */
function calculQuantiteRecette($recette, $DOSE_ALCOOL, $DOSE_DILUANT)
{
    $nbDoseAlcool = $recette->getAlcool()->getQtBoissonEnCours() / $DOSE_ALCOOL; //Calcul du nombre de doses d'alcool possible par rapport à la quantité d'alcool disponible

    $nbDoseDiluant = $recette->getDiluant()->getQtBoissonEnCours() / $DOSE_DILUANT  ; //Calcul du nombre de doses de diluant possible par rapport à la quantité de diluant disponible


    if ($nbDoseAlcool <= 0 || $nbDoseDiluant <= 0) { //Si il n'y a pas de doses d'alcool ou de diluant, on ne peut pas faire de recette
        return $recette; //On retourne l'objet recettePossible
    }

    if ($nbDoseAlcool <= $nbDoseDiluant) { //Compare les 2 nombres de le doses et si il y a plus de doses de diluant que d'alcool; le limitant est l'alcool

        $qtDiluant = $nbDoseAlcool * $DOSE_DILUANT; //On calcule la quantité de diluant que l'on va avoir en fonction du nombre de doses maximale (nombre de doses d'alcool)

        $qtAlcool = $nbDoseAlcool * $DOSE_ALCOOL; //On calcule la quantité d'alcool que l'on va avoir en fonction du nombre de doses maximale (nombre de doses d'alcool)

        $recette->setQtRecette($qtAlcool + $qtDiluant); //On remplace la quantité de recette possible actuelle par la quantité totale (diluant + alcool)

        $recette->setQtAlcool($qtAlcool); //On remplace la quantité d'alcool actuelle par le résultat de qtAlcool

        $recette->setQtDiluant($qtDiluant); //On remplace la quantité de diluant actuelle par le résultat de qtDiluant
    } else { //le limitant est le diluant


        $qtDiluant = $nbDoseDiluant * $DOSE_DILUANT; //On calcule la quantité de diluant que l'on va avoir en fonction du nombre de doses maximale (nombre de doses de diluant)

        $qtAlcool = $nbDoseDiluant * $DOSE_ALCOOL; //On calcule la quantité d'alcool que l'on va avoir en fonction du nombre de doses maximale (nombre de doses de diluant)

        $recette->setQtRecette($qtAlcool + $qtDiluant);  //On remplace la quantité de recette possible actuelle par la quantité totale (diluant + alcool)

        $recette->setQtAlcool($qtAlcool); //On remplace la quantité d'alcool actuelle par le résultat de qtAlcool

        $recette->setQtDiluant($qtDiluant); //On remplace la quantité de diluant actuelle par le résultat de qtDiluant
    }

    return $recette;
}

/*
 * @brief calcule la quantité totale d'alcool et de diluant que l'on a en stock (pas autre)
 * @param Stock $stockSoiree contient toutes les listes de boissons
 * @param int $tailleStockSoireeAlcool taille de la liste d'alcool du stock $stockSoiree
 * @param int $tailleStockSoireeDiluant taille de la liste de diluants du stock $stockSoiree
 * @return int $qtMax la quantité totale d'alcool et de diluant que l'on a en stock (pas autre)
 */
function calculQuantiteMax($stockSoiree, $tailleStockSoireeAlcool, $tailleStockSoireeDiluant)
{
    $qtMax = 0;

    for ($i = 0; $i < $tailleStockSoireeAlcool; $i++) {
        $alcool = $stockSoiree->getLAlcools()[$i]; //Pour chaque élément de la liste d'alcools de notre stock
        $quantite = $alcool->getQtBoissonInitiale(); //on récupère sa quantité initiale
        $qtMax = $qtMax + $quantite; //on l'ajoute à la variable qtMax 

    }

    for ($i = 0; $i < $tailleStockSoireeDiluant; $i++) {
        $diluant = $stockSoiree->getLDiluants()[$i];  //Pour chaque élément de la liste de diluants de notre stock
        $quantite = $diluant->getQtBoissonInitiale(); //on récupère sa quantité initiale 
        $qtMax = $qtMax + $quantite; //on l'ajoute à la variable qtMax
    }

    return $qtMax;
}

function creerRecette($nomFichier)
/**
 * Créer une recette à partir d'un fichier
 * @param $nomFichier : le nom du fichier
 * @return Recette : la recette créée
 */
{
    //Ouvrir et décoder le fichier json
    $json_data = ouvrirJson($nomFichier);
    //Creation d'un tableau de recettes
    $recettesExistantes = array();

    //Creation de variables pour les recettes
    $listeAlcool = array();
    $listeDiluant = array();
    $indexAlcool = false;
    $indexDiluant = false;

    //Parcourss du json
    foreach ($json_data['Recette'] as $recette) {

        //Recuperation du nom de la recette
        $nomRecette = $recette["nomRecette"];

        //Recuperation de l'alcool
        $alcool = $recette["alcool"];

        $estTrouve = false;
        $indexAlcool = 0;
        while (!($estTrouve) && ($indexAlcool < count($listeAlcool))) {
            if ($listeAlcool[$indexAlcool]->getNomBoisson() == $alcool) {
                $estTrouve = true;
                $objetAlcool = $listeAlcool[$indexAlcool];
            } else {
                $indexAlcool++;
            }
        }
        if (!($estTrouve)) {
            $objetAlcool = new Boisson($alcool, "Alcool", 0, 0);
            array_push($listeAlcool, $objetAlcool);
        }


        //Recuperation du diluant
        $diluant = $recette["diluant"];

        $estTrouve = false;
        $indexDiluant = 0;
        while (!($estTrouve) && ($indexDiluant < count($listeDiluant))) {
            if ($listeDiluant[$indexDiluant]->getNomBoisson() == $diluant) {
                $estTrouve = true;
                $objetDiluant = $listeDiluant[$indexDiluant];
            } else {
                $indexDiluant++;
            }
        }
        if (!($estTrouve)) {
            $objetDiluant = new Boisson($diluant, "Diluant", 0, 0);
            array_push($listeDiluant, $objetDiluant);
        }

        //Creation de l'objet Recette
        $$nomRecette = new Recette($nomRecette, $objetAlcool, $objetDiluant, 0, 0, 0, 0);
        //Ajout de la recette au tableau
        array_push($recettesExistantes, $$nomRecette);
    }

    //Retourne le tableau de recettes
    return $recettesExistantes;
}

function creerStock($nomFichier)
/**
 * @brief Créer un stock à partir d'un fichier
 * @param $nomFichier : le nom du fichier
 * @return Stock : le stock créé
 */
{
    //Ouverture du fichier bdStock.json
    $json_data = ouvrirJson($nomFichier);
    //Creation de l'objet stockSoiree
    $stockSoiree = new Stock();

    //Parcours des donnes
    foreach ($json_data['Stock'] as $stock) {
        //Ajout de la boisson au stock
        $stockSoiree->ajouterBoisson("./datas/bdBoissons.json", $stock["nomBoisson"], $stock["qtBoisson"]);
    }
    return $stockSoiree;
}

/**
 * @author oier Cesat <ocesat@iutbayonne.univ-pau.fr>
 * @brief permet d'extrire toutes les recettes possibles grâce au stock de la soirée 
 * @param Stock $stockSoiree
 * @param array $recettesExistantes
 * @return array liste de recette possible grâce à notre stock
 */
function rechercheRecettes($stockSoiree, $recettesExistantes)
{

    // Initialisation des listes
    $recettesTemp = array();        //variable temporaire pour effectuer un deuxième tri dans une liste déjà triée une première fois 
    $recettesPossibles = array();   //liste de recette possible grâce à notre stock

    //Instanciation des variables taille
    $tailleStockSoireeAlcool = sizeof($stockSoiree->getLAlcools());
    $tailleStockSoireeDiluant = sizeof($stockSoiree->getLDiluants());
    $tailleRecettesExistantes = sizeof($recettesExistantes);

    //Premiere boucle permetant de recherche les recettes pouvant être réalisées grâce au stock d'alcool
    for ($i = 0; $i < $tailleStockSoireeAlcool; $i++) {
        for ($j = 0; $j < $tailleRecettesExistantes; $j++) {
            if ($stockSoiree->getLAlcools()[$i]->getNomBoisson() == rtrim($recettesExistantes[$j]->getAlcool()->getNomBoisson())) {
                $recettesExistantes[$j]->setQtAlcool($stockSoiree->getLAlcools()[$i]->getQtBoissonInitiale());
                $recettesExistantes[$j]->getAlcool()->setQtBoissonInitiale($stockSoiree->getLAlcools()[$i]->getQtBoissonInitiale());
                $recettesExistantes[$j]->getAlcool()->setQtBoissonEnCours($stockSoiree->getLAlcools()[$i]->getQtBoissonInitiale());
                array_push($recettesTemp, $recettesExistantes[$j]);
            }
        }
    }

    //Instanciation de la taille de recettesTemp
    $tailleRecettesTemp = sizeof($recettesTemp);

    //Deuxième boucle permetant de recherche les recettes pouvant être réalisées grâce au stock de diluant 
    for ($i = 0; $i < $tailleStockSoireeDiluant; $i++) {
        for ($j = 0; $j < $tailleRecettesTemp; $j++) {
            if ($stockSoiree->getLDiluants()[$i]->getNomBoisson() == rtrim($recettesTemp[$j]->getDiluant()->getNomBoisson())) {
                $recettesTemp[$j]->setQtDiluant($stockSoiree->getLDiluants()[$i]->getQtBoissonInitiale());
                $recettesTemp[$j]->getDiluant()->setQtBoissonInitiale($stockSoiree->getLDiluants()[$i]->getQtBoissonInitiale());
                $recettesTemp[$j]->getDiluant()->setQtBoissonEnCours($stockSoiree->getLDiluants()[$i]->getQtBoissonInitiale());
                array_push($recettesPossibles, $recettesTemp[$j]);
            }
        }
    }
    return $recettesPossibles;
};


/**
 * @brief Ouvre un fichier json
 * @author RobinAlonzo
 * @param string $nomFichier le nom du fichier
 * @return mixed $json_data le fichier json
 */
function ouvrirJson($nomFichier)
{
    //Ouverture du fichier 
    $json = file_get_contents($nomFichier);
    //Decode le json
    $json_data = json_decode($json, true);
    return $json_data;
}


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
            for ($i = $iterateurRecette + 1; $i < $tailleRecettesPossibles; $i++) {
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

            if ($recettesPossibles[$iterateurRecette]->getAlcool()->getQtBoissonEnCours() > 0) {
                $recettesPossibles[$iterateurRecette]->getAlcool()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getAlcool()->getQtBoissonEnCours() - $recettesPossibles[$iterateurRecette]->getQtAlcool());
            } else {
                $recettesPossibles[$iterateurRecette]->getAlcool()->setQtBoissonEnCours(0);
            }

            if ($recettesPossibles[$iterateurRecette]->getDiluant()->getQtBoissonEnCours() > 0) {

                $recettesPossibles[$iterateurRecette]->getDiluant()->setQtBoissonEnCours($recettesPossibles[$iterateurRecette]->getDiluant()->getQtBoissonEnCours() - $recettesPossibles[$iterateurRecette]->getQtDiluant());
            } else {
                $recettesPossibles[$iterateurRecette]->getDiluant()->setQtBoissonEnCours(0);
            }


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
            else {
                //sinon on passe a la recette suivante
                if ($recettesPossibles[$iterateurRecette + 1]->getAlcool()->getQtBoissonEnCours() == 0 || $recettesPossibles[$iterateurRecette + 1]->getDiluant()->getQtBoissonEnCours() == 0) {

                    $iterateurRecette = $iterateurRecette + 2;

                    if ($iterateurRecette >= $tailleRecettesPossibles - 1) {
                        array_push($brancheValide, $brancheEnCours);
                        break 1;
                    }                    
                } else {
                    $iterateurRecette++;
                }
            }

        }
    }

    /* --------------------- Trouver la meilleur possibilité -------------------- */

    //Mise à jour de la taille de la branche valide

    $tailleBrancheValide = sizeof($brancheValide);

    $meilleureValeure = 0;

    //Parcourss de toutes les branches valide
    for ($i = 0; $i < $tailleBrancheValide; $i++) {
        if ($meilleureValeure <= $brancheValide[$i]->getQtValeur()) {
            $meilleureValeure = $brancheValide[$i]->getQtValeur();
            $meilleureCombinaison = $brancheValide[$i];
        }
    }

    /* ----------------------------- return ----------------------------- */
    return $meilleureCombinaison;
}
