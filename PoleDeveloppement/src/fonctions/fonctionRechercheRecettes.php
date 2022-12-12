<?php
    include("../classes/Stock.php");
    include("../classes/Boisson.php");
    include("../classes/Recette.php");

    $recettesExistantes = array();
    $recettesTemp = array();
    $recettesPossibles = array();
    $bdRecettes=fopen("../bdRecettes.txt", "r");
    
    while (! (feof($bdRecettes))) {
        $ligne = fgets($bdRecettes);
        $ligneExplode = explode(",", $ligne);
        $uneRecetteBD = new Recette();
        $uneRecetteBD->setNomRecette($ligneExplode[0]." ".$ligneExplode[1]);
        $uneRecetteBD->setAlcool($ligneExplode[0]);
        $uneRecetteBD->setDiluant($ligneExplode[1]);

        array_push($recettesExistantes, $uneRecetteBD);
    }

    $coca=new Boisson("coca",2,10,10);
    $rhum=new Boisson("rhum",1,5,5);

    $stockSoiree=new Stock ();
    $stockSoiree->setLDiluants($coca);
    $stockSoiree->setLAlcools($rhum);

    $tailleStockSoireeAlcool=sizeof($stockSoiree->getLAlcools());
    $tailleStockSoireeDiluant = sizeof($stockSoiree->getLDiluants());
    $tailleRecettesExistantes = sizeof($recettesExistantes);


    for ($i=0; $i <$tailleStockSoireeAlcool ; $i++) { 
        for ($j=0; $j < $tailleRecettesExistantes; $j++) {
            if ($stockSoiree->getLAlcools()[$i]->getNomBoisson()==$recettesExistantes[$j]->getAlcool()) {
                array_push($recettesTemp, $recettesExistantes[$j]);
            }
        }
    }

$tailleRecetteTemp = sizeof($recettesTemp);

    for ($i=0; $i <$tailleStockSoireeDiluant ; $i++) { 
        for ($j=0; $j < $tailleRecetteTemp; $j++) {

            if ($stockSoiree->getLDiluants()[$i]->getNomBoisson()==rtrim( $recettesTemp[$j]->getDiluant())) {
                echo "salut";
                array_push($recettesPossibles, $recettesTemp[$j]);
            }
        }
    }

    print_r($recettesPossibles);
