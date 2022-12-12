<?php
    include ("Recette.php");
    include ("Boisson.php");
    include ("Branche.php");
    include ("Stock.php");
    include ("calculQuantiteMax.php");

    $biere = new Boisson("Biere", "Autre",5,5 );
    
    $rhum = new Boisson("Rhum", "Alcool", 8, 8);

    $ricard = new Boisson("Ricard", "Alcool", 10, 10);

    $crazy = new Boisson("Crazy", "Diluant",6,6);
    
    print($ricard->toString());
    
    echo "<br/><br/>";
    
    $mazout = new Recette("Mazout", $ricard, new Boisson("Coca", "Diluant", 20, 20), "999", "1", "5", "0");
    print($mazout->toString());
    
    echo "<br/><br/>";
    
    $branche = new Branche([$mazout], 66, 911);
    print($branche->toString());
    
    echo "<br/><br/>";

    $stock = new Stock($ricard,$biere,$rhum,$crazy);

    echo "<br/><br/>";

    print($stock->toString());
    echo "<br/>";
    print(sizeof($stock->getLAlcools()) . " Alcools");

    echo "<br/>";
    echo "<br/>";

    print(calculQuantiteMax($stock). "L maximum de boisson"); echo "<br/>";echo "<br/>";

    $stock->supprLAlcools($rhum);
    $stock->supprLAutres($biere);


    print($stock->toString());
    echo "<br/>";
    print(sizeof($stock->getLAlcools()) . " Alcool");
    echo "<br/>";
    print(calculQuantiteMax($stock). "L maximum de boisson");
?>
