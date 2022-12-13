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
    // -- Tests fonction creerRecette --
    include ("fonctions/creationRecette.php");
    $recettes = creerRecette("./datas/bdRecettes.json");
    foreach ($recettes as $recette) {
        echo ($recette->toString()."<br/><br/>");
    }

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
?>
