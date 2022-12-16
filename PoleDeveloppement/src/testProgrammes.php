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

    include("./classes/Recette.php");
    include("./classes/Boisson.php");
    include("./classes/Branche.php");
    include("./classes/Stock.php");
    include("./fonctions/calculQuantiteRecette.php");
    include("./fonctions/calculQuantiteMax.php");
    include("./fonctions/sacApo.php");
    
    
    
    $recettesExistantes = array();
    $meilleureCombinaison = new Branche();
    $qtMax =18;
    define("DOSE_ALCOOL", 4);
    define("DOSE_DILUANT", 21);
    
    $boisson1 = new Boisson("Whisky", "Alcool", 0.75, 0.75);
    $boisson2 = new Boisson("Coca", "Diluant", 8, 8);
    $recette1 = new Recette("Whisky-coca", $boisson1, $boisson2, 0, 0, 0, 2);
    $recette1 = calculQuantiteRecette($recette1, DOSE_ALCOOL, DOSE_DILUANT);
    array_push($recettesExistantes, $recette1);
    
    $boisson3 = new Boisson("rhum", "Alcool", 1.5, 1.5);
    $boisson4 = new Boisson("Ananas", "Diluant", 3, 3);
    $recette2 = new Recette("rhum-ananas", $boisson3, $boisson4, 0, 0, 0, 1);
    $recette2 = calculQuantiteRecette($recette2, DOSE_ALCOOL, DOSE_DILUANT);
    array_push($recettesExistantes, $recette2);
    
    $boisson5 = new Boisson("Jägermeister ", "Alcool", 0.75, 0.75);
    $boisson6 = new Boisson("Crazy Tiger", "Diluant", 4, 4);
    $recette3 = new Recette("jagerbomb", $boisson5, $boisson6, 0, 0, 0, 2);
    $recette3 = calculQuantiteRecette($recette3, DOSE_ALCOOL, DOSE_DILUANT);
    array_push($recettesExistantes, $recette3);
    
    $recette4 = new Recette("rhum-coca", $boisson3, $boisson2, 0, 0, 0, 1);
    $recette4 = calculQuantiteRecette($recette4, DOSE_ALCOOL, DOSE_DILUANT);
    array_push($recettesExistantes, $recette4);
    
    $tailleReceteExistante = sizeof($recettesExistantes);
    $stockSoiree = new Stock();
    $stockSoiree->setLAlcools($boisson1);
    $stockSoiree->setLDiluants($boisson2);
    $stockSoiree->setLAlcools($boisson3);
    $stockSoiree->setLDiluants($boisson4);
    $stockSoiree->setLAutres($boisson5);
    $stockSoiree->setLDiluants($boisson6);
    
    $meilleureCombinaison = sacApo($recettesExistantes, $tailleReceteExistante, $qtMax, DOSE_ALCOOL, DOSE_DILUANT);
    echo "La meilleure combinaison est : " . $meilleureCombinaison->toString() . "<br>";
    
?>
