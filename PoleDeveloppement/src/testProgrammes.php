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
    $mazout = new Recette("Mazout", $ricard, new Boisson("Coca", "Diluant", 10, 10), "999", "1", "5", "0");
    $perroquet = new Recette("Perroquet", $ricard, new Boisson("Sirop de menthe", "Diluant", 5, 5), "999", "1", "5", "0");
    echo ($mazout->toString()."<br/><br/>");
    
    // -- Tests classe Branche --
    $branche = new Branche([$mazout, $perroquet], 66, 911);
    echo ($branche->toString()."<br/><br/>");

    // -- Tests classe Stock --
    $stock = new Stock($ricard,$biere,$rhum,$crazy);
    $stock->ajouterBoisson("./datas/bdBoissons.json", "coca", 10);
    echo ($stock->toString()."<br/><br/>");
    

    //-------------------
    //--- FONCTIONS  ----
    //-------------------
    // -- Tests fonction creerRecette --
    include ("fonctions/creationRecette.php");
    $recettes = creerRecette("./datas/bdRecettes.json");
    foreach ($recettes as $recette) {
        echo ($recette->toString()."<br/><br/>");
    }
  

    // -- Tests fichier calculQuantiteMax
    include ("fonctions/calculQuantiteMax.php");

    $tailleStockSoireeAlcool = count($stock->getLAlcools());
    $tailleStockSoireeDiluant = count($stock->getLDiluants());

    echo (sizeof($stock->getLAlcools())." Alcools<br/><br/>");
    echo (calculQuantiteMax($stock,$tailleStockSoireeAlcool,$tailleStockSoireeDiluant). " Le maximum de boisson<br/><br/>");
    
    $stock->supprLAlcools($rhum); //supprime le rhum de la liste d'alcool
    $stock->supprLAutres($biere); //supprime la biere de la liste autre

    $tailleStockSoireeAlcool = count($stock->getLAlcools());//On actualise le nombre d'alcool dans la liste
    $tailleStockSoireeDiluant = count($stock->getLDiluants());//On actualise le nombre de diluants dans la liste

    echo($stock->toString()."<br/><br/>");
    echo(sizeof($stock->getLAlcools()) . " Alcool<br/>");
    print(calculQuantiteMax($stock,$tailleStockSoireeAlcool,$tailleStockSoireeDiluant). " Le maximum de boisson<br/>");


    // -- Test fichier calculQuantiteRecette
    echo("<br/>");

    include ("fonctions/calculQuantiteRecette.php");

    $DOSE_ALCOOL = 0.04;
    $DOSE_DILUANT = 0.21;

    print_r(calculQuantiteRecette($perroquet, $DOSE_ALCOOL, $DOSE_DILUANT));


    // -- Test fichier calculQuantiteDesRecettes
    echo("<br/> <br/>");

    include ("fonctions/calculQuantiteDesRecettes.php");

    $recettesPossibles = array(); //On crée la liste des recettes possibles

    array_push($recettesPossibles, $mazout,$perroquet); //On ajoute les recettes à la liste

    $tailleStockSoireePossible = count($recettesPossibles); //nombre de recettes dans la liste

    print_r(calculQuantiteDesRecettes($recettesPossibles,$DOSE_ALCOOL,$DOSE_DILUANT,$stock,$tailleStockSoireeAlcool,$tailleStockSoireeDiluant,$tailleStockSoireePossible));

    // $bdBoisson = array();
    // $stockSoiree = new Stock();

    // $fichierBdBoisson = fopen("datas/bdBoisson.txt", "r");
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
?>
