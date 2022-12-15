<?php
    function creerRecette($nomFichier)
    /**
     * Créer une recette à partir d'un fichier
     * @param $nomFichier : le nom du fichier
     * @return Recette : la recette créée
     */
    {
        //Ouvrir et décoder le fichier json
        $json_data = ouvrirJson($nomFichier);
        //Creation d'un tableau de recettes
        $recettesExistantes = array();

        //Parcourss du json
        foreach ($json_data['Recette'] as $recette) {
            //Recuperation du nom de la recette
            $nomRecette = $recette["nomRecette"];
            //Recuperation de l'alcool
            $alcool = $recette["alcool"];
            //Recuperation du diluant
            $diluant = $recette["diluant"];
            //Creation de l'objet Recette
            $$nomRecette = new Recette($nomRecette, new Boisson($alcool, "Alcool", 0, 0), new Boisson($diluant, "Diluant", 0, 0), 0, 0, 0, 0);
            //Ajout de la recette au tableau
            array_push($recettesExistantes, $$nomRecette);
        }

        //Retourne le tableau de recettes
        return $recettesExistantes;
    }

?>