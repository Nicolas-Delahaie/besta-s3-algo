<?php
/**
 * @author RobinAlonzo
 * @version 1.0.0
 * @file ouvertureJson.php
 */

function ouvrirJson($nomFichier)
        /**
         * @brief Ouvre un fichier json
         * @param $nomFichier : le nom du fichier
         * @return json_data : le fichier json
         */
    {
        //Ouverture du fichier bdStock.json
        $json = file_get_contents($nomFichier);
        //Decode le json
        $json_data = json_decode($json,true);
        return $json_data;
    }
?>