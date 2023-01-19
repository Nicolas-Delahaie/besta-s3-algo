<?php
/**
 * @brief Retourne les variables transmises dans _POST si elles sont exploitables
 * @param array qtBoisson dans $_POST
 * @param array nomBoisson dans $_POST
 * @return array de la forme [nomBoisson,qtBoisson]
 */
function saisieVerif()
{
    $resultat=array();
    if ($_POST['qtBoisson'] != "") {
        if ($_POST['nomBoisson'] == 'default') {
            header("Location: ./../../index.php");
        }

        $nomBoisson = $_POST['nomBoisson'];
        $qtBoisson = $_POST['qtBoisson'];

        array_push($resultat,$nomBoisson,doubleval($qtBoisson));
        header("Location: ./../../index.php");
    } 
    else {
        header("Location: ./../../index.php");
    }
    return $resultat;
}

/**
 * @brief Remplie la base de donnée avec la boisson et son volume entrés dans _POST
 * @param array qtBoisson dans $_POST
 * @param array nomBoisson dans $_POST
 */
function remplirStock ()
{
    // Récupération du nom et de la quantité fourinie par l'utilisateur
    $resultatSaisieVerif = saisieVerif();

    // Récupération du nom de la boisson
    $boissonSaisie = array(
        "nomBoisson" => $resultatSaisieVerif[0],
        "qtBoisson" => $resultatSaisieVerif[1]
    );


    //Ouverture fichier json
    $json = file_get_contents("./../datas/bdStock.json");
    //Decode le json
    $json_data = json_decode($json,true);

    //Parcourss du json, pour chercher si la boisson est déjà dans le fichier
    $boissonTrouve = false;
    $position = 0;
    while ($boissonTrouve != true &&  $position < count($json_data["Stock"])) {
        //Si la boisson est déjà dans le fichier
        if ($json_data["Stock"][$position]["nomBoisson"] == $boissonSaisie["nomBoisson"])
        {
            //On modifie la quantité
            $json_data["Stock"][$position]["qtBoisson"] += $boissonSaisie["qtBoisson"];
            //On modifie le fichier json
            file_put_contents('./../datas/bdStock.json', json_encode($json_data));
            //On sort de la boucle
            $boissonTrouve = true;
        }
        else{
            //On passe à la boisson suivante
            $position = $position + 1;
        }
    }

    //Si la boisson n'est pas dans le fichier
    if ($boissonTrouve == false)
    {
        //On ajoute la boisson au fichier
        array_push($json_data["Stock"], $boissonSaisie);
        //Ecriture dans le fichier json
        file_put_contents('./../datas/bdStock.json', json_encode($json_data));
    }
};

remplirStock();
?>