<?php
function remplirStock ()
    /**
     * @author : Robin
     * @brief Remplie la base de donnée contenant le stock de boisson
     */
{
    // Récupération du nom et de la quantité fourinie par l'utilisateur
    $resultatSaisieVerif = saisieVerif();

    //Ouverture fichier json
    $json = file_get_contents("./../datas/bdStock.json");
    //Decode le json
    $json_data = json_decode($json,true);

    //Parcourss du json, pour chercher si la boisson est déjà dans le fichier
    $boissonTrouve = false;
    $position = 0;
    while ($boissonTrouve != true &&  $position < count($json_data["Stock"])) {
        //Si la boisson est déjà dans le fichier
        if ($json_data["Stock"][$position]["nomBoisson"] == $resultatSaisieVerif[0])
        {
            //On modifie la quantité
            $json_data["Stock"][$position]["qtBoisson"] += $resultatSaisieVerif[1];
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

/**
 * @author @oiercesat <ocesat@iutbayonne.univ-pau.fr>
 * Summary of saisiVerif
 * @brief vérifie que les variables transmise sont exploitable
 * @return array liste sous la forme [nomBoisson,qtBoisson]
 */
function saisieVerif()
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

?>