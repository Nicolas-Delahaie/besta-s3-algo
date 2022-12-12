<html>

<body>
    <form action="main.php" method="POST">
        <p>Insérez le nom de la recette </p>
        <input type="text" name="nomBoisson" id="nomBoisson">
        <p>Insérez la quantité de votre boisson</p>
        <input type="number" name="qtBoisson" value="qtBoisson">
        <br>
        <input type="submit" value="Valider">
    </form>
</body>

</html>


<?php

include("classes/Stock.php");
include("classes/Boisson.php");

$nomBoissonSaisie=$_POST['nomBoisson'];
$qtBoissonSaisie=$_POST['qtBoisson'];

$stockSoiree= new Stock();

    if ($nomBoissonSaisie !="" && $qtBoissonSaisie !="") {
        
        $boissonSaisie=new Boisson();
        $bdBoisson=fopen("bdBoisson.txt","r");

        while (!feof($bdBoisson)) {
            
            $ligneBD=fgets($bdBoisson);
            $ligneExplode=explode(",",$ligneBD);

            $nomBoissonBD=$ligneExplode[0];
            $typeBoisson=$ligneExplode[1];

            if ($nomBoissonBD=$nomBoissonSaisie) {
                
                if ($typeBoisson=="alcool") {
                    
                    $boissonSaisie->setNomBoisson($nomBoissonSaisie);
                    $boissonSaisie->setQtBoissonInitiale($qtBoissonSaisie);
                    $boissonSaisie->setQtBoissonEnCours($qtBoissonSaisie);
                    $boissonSaisie->setTypeBoisson(1);

                    $stockSoiree->setLAlcools($boissonSaisie);

                    break;
                }
                if ($typeBoisson=="diluant") {
                    
                    $boissonSaisie->setNomBoisson($nomBoissonSaisie);
                    $boissonSaisie->setQtBoissonInitiale($qtBoissonSaisie);
                    $boissonSaisie->setQtBoissonEnCours($qtBoissonSaisie);
                    $boissonSaisie->setTypeBoisson(2);

                    $stockSoiree->setLAlcools($boissonSaisie);

                    break;
                }
                if ($typeBoisson=="autre") {
                    
                    $boissonSaisie->setNomBoisson($nomBoissonSaisie);
                    $boissonSaisie->setQtBoissonInitiale($qtBoissonSaisie);
                    $boissonSaisie->setQtBoissonEnCours($qtBoissonSaisie);
                    $boissonSaisie->setTypeBoisson(3);

                    $stockSoiree->setLAlcools($boissonSaisie);

                    break;
                }
            fclose($bdBoisson);
            }
        }

        print("votre boisson a bien était prise en compte <br>");
        print("Voici le stock : ".$stockSoiree->toString()."<br>");
    } 
    else {
        print("j'ai rien");
    }
?>