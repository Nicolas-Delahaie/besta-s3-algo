<?php
    include ("Recette.php");
    include ("Boisson.php");
    include ("Branche.php");
    include ("Stock.php");

    $ricard = new Boisson("Ricard", "Alcool", 10, 2);
    print($ricard->toString());
    echo "<br/><br/>";
    $mazout = new Recette("Mazout", $ricard, new Boisson("Coca", "Soft", 20, 10), "999", "1", "5", "0");
    print($mazout->toString());
    echo "<br/><br/>";
    $branche = new Branche([$mazout], 66, 911);
    print($branche->toString());
    echo "<br/><br/>";
    // $stock = new Stock();
    // print($branche->toString());
    // echo "<br/><br/>";
?>
