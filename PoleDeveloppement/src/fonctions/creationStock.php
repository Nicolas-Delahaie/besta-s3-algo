<?
    function creerStock($nomFichier)
        /**
         * @brief Créer un stock à partir d'un fichier
         * @param $nomFichier : le nom du fichier
         * @return Stock : le stock créé
         */
    {
        //Ouverture du fichier bdStock.json
        $json_data = ouvrirJson($nomFichier);
        //Creation de l'objet stockSoiree
        $stockSoiree = new Stock();

        //Parcours des donnes
        foreach ($json_data['Stock'] as $stock)
        {
            //Ajout de la boisson au stock
            $stockSoiree->ajouterBoisson("./../datas/bdBoissons.json", $stock["nomBoisson"], $stock["qtBoisson"]);
        }
        return $stockSoiree;
    }

?>
