<?php
/**
 * Summary of remplirStock
 * @brief remplie le stock de la soirée selon ce que l'utilisateur à rempli
 * @param array $bdBoissons liste de boisson contenue dans notre base de donnée
 * @param int $tailleBdBoissons taille de la liste bdBoisson
 * @param Stock $stockSoiree objet contenant la liste des boissons de la soirée
 * @return Stock $stockSoiree objet contenant la liste des boissons de la soirée
 */
function remplirStock ($bdBoissons, $tailleBdBoissons, $stockSoiree) {

    // Récupération du nom et de la quantité fourinie par l'utilisateur
    $resultatSaisieVerif = saisiVerif();

    //Création d'une variable temporaire $boissonSaisie
    $boissonSaisie = new Boisson($resultatSaisieVerif[0], 0, $resultatSaisieVerif[1], $resultatSaisieVerif[1]);

    //Parcours de la liste $bdBoisson afin de trouver la boisson qui comporte le même nom
    for ($i = 0; $i < $tailleBdBoissons; $i++) {
        if ($bdBoissons[$i]->getNomBoisson() == $boissonSaisie->getNomBoisson()) {
            switch ($bdBoissons[$i]->getTypeBoisson()) {

                //Si la boisson est de type 1:alcool
                case 1:
                    $boissonSaisie->setTypeBoisson($bdBoissons[$i]->getTypeBoisson());

                    //Ajout de $boissonSaisie dans la liste d'alcool de $stockSoiree
                    $stockSoiree->setLAlcools($boissonSaisie);
                    break;

                //Si la boisson est de type 2:diluant
                case 2:
                    $boissonSaisie->setTypeBoisson($bdBoissons[$i]->getTypeBoisson());

                    //Ajout de $boissonSaisie dans la liste de diluant de $stockSoiree
                    $stockSoiree->setLDiluants($boissonSaisie);
                    break;

                //Si la boisson est de type 1:autre
                case 3:
                    $boissonSaisie->setTypeBoisson($bdBoissons[$i]->getTypeBoisson());

                    //Ajout de $boissonSaisie dans la liste autres de $stockSoiree
                    $stockSoiree->setLAutres($boissonSaisie);
                    break;

                //Si la fonction comporte un probleme 
                default:
                    echo "erreur dans le switch";
                    break;
            }
        }
    }
    return $stockSoiree;
};

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
