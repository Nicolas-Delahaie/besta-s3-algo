<?php
/* -------------------------------------------------------------------------- */
/*                                   INCLUDES                                 */
/* -------------------------------------------------------------------------- */

/* --------------------------------- CLASSES -------------------------------- */

include("./classes/Boisson.php");
include("./classes/Branche.php");
include("./classes/Recette.php");
include("./classes/Stock.php");


/* -------------------------------- FONCTIONS ------------------------------- */

include("./fonctions/fonctionsMain.php");

/* -------------------------------------------------------------------------- */
/*                     DECLARATIONS DES VARIABLES ET CONSTANTES DU MAIN                     */
/* -------------------------------------------------------------------------- */

/* ------------------------------- Variables ------------------------------- */

$stockSoiree = creerStock("./datas/bdStock.json");
$recettesExistantes = creerRecette("./datas/bdRecettes.json");
$meilleureCombinaison = new Branche();
$recettesPossibles = array();

$qtMax = 0;

/* ------------------------------- Constantes ------------------------------- */

define("DOSE_ALCOOL", 4);
define("DOSE_DILUANT", 21);

/* -------------------------------------------------------------------------- */
/*              INSTANCIATION DES OBJETS ET DES VARIBLES DU MAIN              */
/* -------------------------------------------------------------------------- */

/* -------------------------------------------------------------------------- */
/*                             RECHERCHE RECETTES                             */
/* -------------------------------------------------------------------------- */

$recettesPossibles = rechercheRecettes($stockSoiree, $recettesExistantes);
$tailleRecettesPossibles = count($recettesPossibles);


/* -------------------------------------------------------------------------- */
/*                            CALCULE DES QUANTITES                           */
/* -------------------------------------------------------------------------- */

$valeursRenvoyees = calculQuantiteDesRecettes($recettesPossibles, DOSE_ALCOOL, DOSE_DILUANT, $stockSoiree, $stockSoiree->tailleAlcools(), $stockSoiree->tailleDiluants(), $tailleRecettesPossibles);

$qtMax = $valeursRenvoyees[0];
$recettesPossibles = $valeursRenvoyees[1];
$tailleRecettesPossibles = count($recettesPossibles);


/* -------------------------------------------------------------------------- */
/*                      CALCULER LES VALEURS DES RECETTES                     */
/* -------------------------------------------------------------------------- */

$recettesPossibles = calculDesValeurs($recettesPossibles);

/* -------------------------------------------------------------------------- */
/*                                   SACAPO                                   */
/* -------------------------------------------------------------------------- */

$meilleureCombinaison = sacApo($recettesPossibles, $tailleRecettesPossibles, $qtMax, DOSE_ALCOOL, DOSE_DILUANT);
// echo $meilleureCombinaison->toString();


/* -------------------------------------------------------------------------- */
/*                        AFFICHAGE DU TABLEAU DE BORD                        */
/* -------------------------------------------------------------------------- */
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Suggestion d'une combinaison de cocktails</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/index.css">
    <link rel="stylesheet" href="styles/page_affichage_suggestion.css">
</head>

<body>
    <section id="containerPrincipal">
        <header>
            <h1>Cocktails optimaux</h1>
        </header>
        <main>
            <?php
            /**
             * @brief Affiche la combinaison de cocktails avec les restes
             * @param array Cocktails triés par volume total décroissant
             * @param array Boisson Restes de boissons triés par volulmme decroisant 
             */

            $html = "";

            $nbVerresTotaux = 0;
            $nbShotsTotaux = 0;

            // ------- Cocktails -------
            for ($i = 0; $i < count($meilleureCombinaison->getPRecette()); $i++) {
                $recetteAffichee = $meilleureCombinaison->getPRecette()[$i];
                $html .= '<article>';
                $html .= '<img src="datas/img/bouteilles/' . $recetteAffichee->getAlcool()->getNomBoisson() . '.jpg" class="imagesBoissons">';
                $html .= '<img src="datas/img/bouteilles/' . $recetteAffichee->getDiluant()->getNomBoisson() . '.jpg" class="imagesBoissons">';
                $html .= '<p class="separateur">=</p>';
                $html .= '<section class="zoneVerres">';
                #Calcul du nombre de verres de 25cl
                $nbVerres = floor($recetteAffichee->getQtRecette() / 0.25);
                $html .= '<p class="nbVerres">' . $nbVerres . ' verres</p>';
                $nbVerresTotaux += $nbVerres;
                for ($n = 0; $n < $nbVerres; $n++) {
                    $html .= '<img src="datas/img/verre.jpg" class="verres">';
                }
                $html .= '</section></article>';
            }

            // ------- Restes -------
            $html .= '<h2>Boissons restantes</h2>';

            $restes = array();
            array_push($restes, $meilleureCombinaison->getPRecette()[0]->getAlcool());
            array_push($restes, $meilleureCombinaison->getPRecette()[0]->getDiluant());

            for ($i = 1; $i < count($meilleureCombinaison->getPRecette()); $i++) {

                $alcoolExiste = false;
                $diluantExiste = false;

                for ($j = 0; $j < count($restes); $j++) {
                    if ($meilleureCombinaison->getPRecette()[$i]->getAlcool()->getNomBoisson() == $restes[$j]->getNomBoisson()) {
                        $alcoolExiste = true;
                    }
                    if ($meilleureCombinaison->getPRecette()[$i]->getDiluant()->getNomBoisson() != $restes[$j]->getNomBoisson()) {
                        $diluantExiste = true;
                    }
                }

                if (!$alcoolExiste) {
                    array_push($restes, $meilleureCombinaison->getPRecette()[$i]->getAlcool());
                }
                if (!$diluantExiste) {
                    array_push($restes, $meilleureCombinaison->getPRecette()[$i]->getDiluant());
                }
            }

            for ($i = 0; $i < count($restes); $i++) {

                if ($restes[$i]->getQtBoissonEnCours() != 0) {
                    $html .= '<article>';
                    $html .= '<img src="datas/img/bouteilles/' . $restes[$i]->getNomBoisson() . '.jpg" class="imagesBoissons imagesRestes">';
                    $html .= '<p class="separateur">=</p>';
                    $html .= '<section class="zoneShots">';
                    #Calcul du nombre de shots de 4cl

                    $nbShots = floor($restes[$i]->getQtBoissonEnCours() / 0.04);

                    $nbShotsTotaux += $nbShots;

                    for ($n = 0; $n < $nbShots; $n++) {
                        $html .= '<img src="datas/img/shot.jpg" class="shots">';
                    }
                    $html .= '</section></article>';
                }
            }

            // ------- Total -------
            $html .= '<h2>Au total</h2>';
            $html .= '<article><p class="sommesFinales">' . strval($nbVerresTotaux) . '</p><p class="separateur">X</p><img src="datas/img/verre.jpg" id="verresTotaux"></article>';
            $html .= '<article><p class="sommesFinales">' . strval($nbShotsTotaux) . '</p><p class="separateur">X</p><img src="datas/img/shot.jpg" id="shotsTotaux"></article>';


            echo $html;
            ?>
        </main>
    </section>
</body>

</html>