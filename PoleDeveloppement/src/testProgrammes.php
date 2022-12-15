<?php
    //-------------------
    //---  CLASSES   ----
    //-------------------

    // -- Tests classe Boisson --
    // $biere = new Boisson("Biere", "Autre",5,5 );
    // $rhum = new Boisson("Rhum", "Alcool", 8, 8);
    // $ricard = new Boisson("Ricard", "Alcool", 10, 10);
    // $crazy = new Boisson("Crazy", "Diluant",6,6);
    // echo ($ricard->toString()."<br/><br/>");
    
    // -- Tests classe Recette --
    // $mazout = new Recette("Mazout", $ricard, new Boisson("Coca", "Diluant", 20, 20), "999", "1", "5", "0");
    // $perroquet = new Recette("Perroquet", $ricard, new Boisson("Sirop de menthe", "Diluant", 20, 20), "999", "1", "5", "0");
    // echo ($mazout->toString()."<br/><br/>");
    
    // // -- Tests classe Branche --
    // $branche = new Branche([$mazout, $perroquet], 66, 911);
    // echo ($branche->toString()."<br/><br/>");

    // // -- Tests classe Stock --
    // $stock = new Stock($ricard,$biere,$rhum,$crazy);
    // echo ($stock->toString()."<br/><br/>");
    



    // //-------------------
    // //--- FONCTIONS  ----
    // //-------------------
    // /**
    //  * @warning Ne fonctionne pas car calculQuantiteMax inclu egalement Stock
    //  */
    // include ("fonctions/calculQuantiteMax.php");

    // // -- Tests fichier calculQuantiteMax
    // echo (sizeof($stock->getLAlcools())." Alcools<br/><br/>");
    // echo (calculQuantiteMax($stock). "Le maximum de boisson<br/><br/>");
    // $stock->supprLAlcools($rhum);
    // $stock->supprLAutres($biere);
    // echo($stock->toString()."<br/><br/>");
    // echo(sizeof($stock->getLAlcools()) . " Alcool<br/>");
    // print(calculQuantiteMax($stock). "Le maximum de boisson<br/>");

    /* -------------------------------------------------------------------------- */
    /*              test pour les fonctions du fichier saisiVerif.php             */
    /* -------------------------------------------------------------------------- */

    // $bdBoisson = array();
    // $stockSoiree = new Stock();

    // $fichierBdBoisson = fopen("../bdBoisson.txt", "r");
    // while (!(feof($fichierBdBoisson))) {
    //     $ligne=fgets($fichierBdBoisson);
    //     $ligneExplode=explode(",",$ligne);
    //     $boissonObjet = new Boisson($ligneExplode[0], $ligneExplode[1], 0, 0);
    //     array_push($bdBoisson, $boissonObjet);
    // }
    // fclose($fichierBdBoisson);

    // $tailleBdBoisson= sizeof($bdBoisson);

    // $resultatSaisieVerif = saisiVerif();
    // $boissonSaisie = new Boisson($resultatSaisieVerif[0], 0, $resultatSaisieVerif[1], $resultatSaisieVerif[1]);

    // echo $stockSoiree->toString();

    /* -------------------------------------------------------------------------- */
    /*                        TEST POUR LA FONCTION SACAPO                        */
    /* -------------------------------------------------------------------------- */

    // include("../classes/Recette.php");
    // include("../classes/Boisson.php");
    // include("../classes/Branche.php");
    // include("../classes/Stock.php");
    // include("./calculQuantiteRecette.php");
    // include("./calculQuantiteMax.php");
    
    
    
    // $recettesExistantes = array();
    // $meilleureCombinaison = new Branche();
    // $qtMax = 8 + 20 + 10 + 20 + 5 + 20;
    // define("DOSE_ALCOOL", 4);
    // define("DOSE_DILUANT", 21);
    
    // $boisson1 = new Boisson("Rhum", "Alcool", 8, 8);
    // $boisson2 = new Boisson("Coca", "Diluant", 20, 20);
    // $recette1 = new Recette("Mazout", $boisson1, $boisson2, 0, 0, 0, 1);
    // $recette1 = calculQuantiteRecette($recette1, DOSE_ALCOOL, DOSE_DILUANT);
    // array_push($recettesExistantes, $recette1);
    
    // $boisson3 = new Boisson("Ricard", "Alcool", 10, 10);
    // $boisson4 = new Boisson("Sirop de menthe", "Diluant", 14, 14);
    // $recette2 = new Recette("Perroquet", $boisson3, $boisson4, 0, 0, 0, 3);
    // $recette2 = calculQuantiteRecette($recette2, DOSE_ALCOOL, DOSE_DILUANT);
    // array_push($recettesExistantes, $recette2);
    
    // $boisson5 = new Boisson("Biere", "Autre", 5, 5);
    // $boisson6 = new Boisson("kas", "Diluant", 20, 20);
    // $recette3 = new Recette("recette3", $boisson1, $boisson6, 0, 0, 0, 1);
    // $recette3 = calculQuantiteRecette($recette3, DOSE_ALCOOL, DOSE_DILUANT);
    // array_push($recettesExistantes, $recette3);
    
    // $recette4 = new Recette("recette4", $boisson1, $boisson2, 0, 0, 0, 2);
    // $recette4 = calculQuantiteRecette($recette4, DOSE_ALCOOL, DOSE_DILUANT);
    // array_push($recettesExistantes, $recette4);
    
    // $recette5 = new Recette("recette5", $boisson3, $boisson2, 0, 0, 0, 4);
    // $recette5 = calculQuantiteRecette($recette5, DOSE_ALCOOL, DOSE_DILUANT);
    // array_push($recettesExistantes, $recette5);
    
    // $recette6 = new Recette("recette6", $boisson1, $boisson4, 0, 0, 0, 3);
    // $recette6 = calculQuantiteRecette($recette6, DOSE_ALCOOL, DOSE_DILUANT);
    // array_push($recettesExistantes, $recette6);
    
    // $tailleReceteExistante = sizeof($recettesExistantes);
    // $stockSoiree = new Stock();
    // $stockSoiree->setLAlcools($boisson1);
    // $stockSoiree->setLAlcools($boisson3);
    // $stockSoiree->setLAutres($boisson5);
    // $stockSoiree->setLDiluants($boisson2);
    // $stockSoiree->setLDiluants($boisson4);
    // $stockSoiree->setLDiluants($boisson6);
    
    // $meilleureCombinaison = sacApo($recettesExistantes, $tailleReceteExistante, $qtMax, DOSE_ALCOOL, DOSE_DILUANT);
    // echo "La meilleure combinaison est : " . $meilleureCombinaison->toString() . "<br>";
    
?>
