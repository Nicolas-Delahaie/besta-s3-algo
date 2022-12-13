<?php
include("../classes/Stock.php");
include("../classes/Boisson.php");

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

for ($i=0; $i < $tailleBdBoisson; $i++) { 
    if ($bdBoisson[$i]->getNomBoisson()==$boissonSaisie->getNomBoisson()) {
        switch ($bdBoisson[$i]->getTypeBoisson()) {
            case 1:
                $boissonSaisie->setTypeBoisson($bdBoisson[$i]->getTypeBoisson());
                $stockSoiree->setLAlcools($boissonSaisie);
                break;
            case 2:
                $boissonSaisie->setTypeBoisson($bdBoisson[$i]->getTypeBoisson());
                $stockSoiree->setLDiluants($boissonSaisie);
                break;
            case 3:
                $boissonSaisie->setTypeBoisson($bdBoisson[$i]->getTypeBoisson());
                $stockSoiree->setLAutres($boissonSaisie);
                break;

            default:
                echo "erreur dans le switch";
                break;
        }
    }
}

echo $stockSoiree->toString();



// header("Location: ../index.php");

/**
 * @author @oiercesat <ocesat@iutbayonne.univ-pau.fr>
 * Summary of saisiVerif
 * @brief vérifie que les variables transmise sont exploitable
 * @return array liste sous la forme [nomBoisson,qtBoisson]
 */
function saisiVerif()
{
    $resultat=array();
    if ($_POST['qtBoisson'] != "") {
        if ($_POST['nomBoisson'] == 'default') {
            header("Location: ../1dex.php");
        }

        $nomBoisson = $_POST['nomBoisson'];
        $qtBoisson = $_POST['qtBoisson'];

        array_push($resultat,$nomBoisson,$qtBoisson);        
    } 
    else {
        header("Location: ../1dex.php");
    }
    return $resultat;
}
