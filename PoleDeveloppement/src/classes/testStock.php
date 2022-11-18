<?php

    require_once('Stock.php');

    $boisson1 = new Boisson("Vodk", 1,2,2);
    $boisson2 = new Boisson("Rhum", 1,2,2);

    $boisson3 = new Boisson("coca", 2,8,8);
    $boisson4 = new Boisson("ice Tea", 2,6,6);

    $boisson5 = new Boisson("Biere", 3,5,5);

    $stockSoiree = new Stock($boisson1,$boisson2,$boisson3,$boisson4,$boisson5);

    $boisson6 = new Boisson("Kas",2,9,9);
    $stockSoiree->setLDiluants($boisson6);

    print($stockSoiree->toString());

    print "<br/>";
    print "<br/>";

    $copieStock = new Stock($stockSoiree);
    print($copieStock->toString());

    print "<br/>";
    print "<br/>";

    $stockVide = new Stock();
    print($stockVide->toString());


    print "<br/>";
    print "<br/>";

    $stockVide->setLDiluants($boisson6);
    print($stockVide->toString());


    print "<br/>";
    print "<br/>";

    $stockMoitieVide = new Stock($boisson6,$boisson2);
    print($stockMoitieVide->toString());
    

?>
