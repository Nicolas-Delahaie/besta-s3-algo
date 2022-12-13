<?php
    //-------------------
    //---  CLASSES   ----
    //-------------------
    include ("classes/Recette.php");
    include ("classes/Boisson.php");
    include ("classes/Branche.php");
    include ("classes/Stock.php");

    // -- Tests classe Boisson --
    $biere = new Boisson("Biere", "Autre",5,5 );
    $rhum = new Boisson("Rhum", "Alcool", 8, 8);
    $ricard = new Boisson("Ricard", "Alcool", 10, 10);
    $crazy = new Boisson("Crazy", "Diluant",6,6);
    echo ($ricard->toString()."<br/><br/>");
    
    // -- Tests classe Recette --
    $mazout = new Recette("Mazout", $ricard, new Boisson("Coca", "Diluant", 20, 20), "999", "1", "5", "0");
    $perroquet = new Recette("Perroquet", $ricard, new Boisson("Sirop de menthe", "Diluant", 20, 20), "999", "1", "5", "0");
    echo ($mazout->toString()."<br/><br/>");
    
    // -- Tests classe Branche --
    $branche = new Branche([$mazout, $perroquet], 66, 911);
    echo ($branche->toString()."<br/><br/>");

    // -- Tests classe Stock --
    $stock = new Stock($ricard,$biere,$rhum,$crazy);
    echo ($stock->toString()."<br/><br/>");
    



    //-------------------
    //--- FONCTIONS  ----
    //-------------------
    /**
     * @warning Ne fonctionne pas car calculQuantiteMax inclu egalement Stock
     */
    include ("fonctions/calculQuantiteMax.php");

    // -- Tests fichier calculQuantiteMax
    echo (sizeof($stock->getLAlcools())." Alcools<br/><br/>");
    echo (calculQuantiteMax($stock). "Le maximum de boisson<br/><br/>");
    $stock->supprLAlcools($rhum);
    $stock->supprLAutres($biere);
    echo($stock->toString()."<br/><br/>");
    echo(sizeof($stock->getLAlcools()) . " Alcool<br/>");
    print(calculQuantiteMax($stock). "Le maximum de boisson<br/>");

    $bdBoisson = array();
    $stockSoiree = new Stock();

    $fichierBdBoisson = fopen("../bdBoisson.txt", "r");
    while (!(feof($fichierBdBoisson))) {
        $ligne=fgets($fichierBdBoisson);
        $ligneExplode=explode(",",$ligne);
        $boissonObjet = new Boisson($ligneExplode[0], $ligneExplode[1], 0, 0);
        array_push($bdBoisson, $boissonObjet);
    }
    fclose($fichierBdBoisson);

    $tailleBdBoisson= sizeof($bdBoisson);

    $resultatSaisieVerif = saisiVerif();
    $boissonSaisie = new Boisson($resultatSaisieVerif[0], 0, $resultatSaisieVerif[1], $resultatSaisieVerif[1]);

    echo $stockSoiree->toString();
?>
