<?php

    /** 
     * @file Stock.php
     * @author @alexandrePascal <apascal003@iutbayonne.univ-pau.fr>
     * @version 6.0
     * @brief Classe Stock representant le stock de boissons d un evenement
    */
    class Stock{
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $lAlcools = array();  /** @var array Liste des alcools du stock (Rhum, Pastis...)*/
        private $lDiluants = array(); /** @var array Liste des diluants du stock (Oasis, Coca...)*/
        private $lAutres = array();   /** @var array Liste des autres boissons du stock (Biere, vin...)*/

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Constructeur d'un objet Stock par défaut, par copie ou par paramètres
         * @param array lAlcools (par parametres) ou Stock (objet a copier)
         * @param array lDiluants (par parametres)
         * @param array lAutres (par parametres)
         */
        function __construct()
        {
            $nbArguments= func_num_args(); //Utilisation de la d'une fonction récupérant le nombre d'arguments passés en paramètre
            $tabArguments=func_get_args(); //Utilisation de la fonction permettant de recupérer les arguments passés en paramètre

            if ($nbArguments == 0) { //Si aucuns argument n'est passé en paramètre
                $this->lAlcools = []; //Les listes sont initilisées vides
                $this->lDiluants = [];
                $this->lAutres = [];
            }

            elseif ($nbArguments == 1) //Si un seul argument est passé en paramètre, c'est un constructeur par copie
            {
                $this->lAlcools=$tabArguments[0]->lAlcools; //On copie donc chaque attributs de l'objet en paramètre dans la copie
                $this->lDiluants=$tabArguments[0]->lDiluants;
                $this->lAutres=$tabArguments[0]->lAutres;
            }

            else{
                
                for ($i = 0; $i <= $nbArguments - 1; $i++) { //Sinon pour chaque argument passé en paramètre :
            
                    switch ($tabArguments[$i]->getTypeBoisson()) { //On regarde quel est le type de cette boisson
                        case "Alcool": //Si c'est de type 1 (alccol)
                            $this->setLAlcools($tabArguments[$i]); //on l'ajoute à la liste d'alcools
                            break;
                        
                        case "Diluant"://Si c'est de type 2 (diluant)
                            $this->setLDiluants($tabArguments[$i]); //on l'ajoute à la liste de diluants 
                            break;
                        
                        case "Autre": //Si c'est le type 3 (autre)
                            $this->setLAutres($tabArguments[$i]); //on l'ajoute à la liste de autres boissons
                            break;

                        default: //Si aucun de ces cas ne sont possibles on indique l'erreur possible
                            print("les parametres ne sont pas bons, les paramètres doivent etre soit nuls, soit des objets de type boisson");
                            break;
                    }   
                }
            }

            
        }

        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETEUR --------------------------------- */
        /** 
         * @brief Retourne la liste des alcools du stock
         * @return array
        */
        function getLAlcools (){
            return $this->lAlcools;
        }    
        /** 
         * @brief Retourne la liste des diluants du stock
         * @return array
        */
        function getLDiluants (){
            return $this -> lDiluants;
        }        
        /** 
         * @brief Retourne la liste des autres boissons du stock
         * @return array
        */
        function getLAutres (){       
            return $this -> lAutres;
        }              

        /* --------------------------------- SETEUR --------------------------------- */
        /**
         * @brief Permet de modifier l'attribut lAlcools
         * @param array lAlcools
         */
        function setLAlcools($nouveauAlcool){ 
            array_push($this->lAlcools, $nouveauAlcool);
        }
        /**
         * @brief Permet de modifier l'attribut lDiluants
         * @param array lDiluants
         */
        function setLDiluants($nouveauDiluant){
            array_push($this->lDiluants, $nouveauDiluant);
        }
        /**
         * @brief Permet de modifier l'attribut lAutres
         * @param array lAutres
         */
        function setLAutres($nouveauAutre){
            array_push($this->lAutres, $nouveauAutre);
        }

        /* --------------------------------- SUPPRESSION --------------------------------- */
        /**
         * @brief Permet de supprimer un alcool du stock
         * @param string nomAlcool
         */
        function supprLAlcools($nomAlcool){
            unset($this->lAlcools[array_search($nomAlcool, $this->lAlcools)]);
        }
        /**
         * @brief Permet de supprimer un diluant du stock
         * @param string nomDiluant
         */
        function supprLDiluants($nomDiluant){
            unset($this->lDiluants[array_search($nomDiluant, $this->lDiluants)]);
        }
        /**
         * @brief Permet de supprimer une boisson autre du stock
         * @param string boissonAutre
         */
        function supprLAutres($boissonAutre){
            unset($this->lAutres[array_search($boissonAutre, $this->lAutres)]); 
        }

        /* -------------------------------- TO STRING ------------------------------- */
        /**
         * @brief Retourne un message recapitulant le stock
         * @return string
         */
        function toString()
        {
            if ($this->lAlcools != []) { //On regarde si notre liste n'est pas vide
                $nbAlcools = count($this->lAlcools); //On compte le nombre d'éléments présents dans la liste des alcools
                $listeDesAlcools = ""; //On prepare le message a afficher

                for ($i = 0; $i <= $nbAlcools - 1; $i++) { //Pour chaque alcool
                    $nomAlcool = $this->lAlcools[$i]->getNomBoisson(); //On récupére son nom
                    $listeDesAlcools = $listeDesAlcools . " " . $nomAlcool; //On le concatène avec les autres noms
                }
            } else { //Si la liste des alcools est vide
                $listeDesAlcools = "aucuns alcools";
            }

            if ($this->lDiluants != []) { //On regarde si notre liste n'est pas vide
                $nbDiluant = count($this->lDiluants); //On compte le nombre d'éléments présents dans la liste des diluants
                $listeDesDiluants = "";//On prepare le message a afficher

                for ($i = 0; $i <= $nbDiluant - 1; $i++) { //pour chaque diluants
                    $nomDiluant = $this->lDiluants[$i]->getNomBoisson();//On récupère son nom
                    $listeDesDiluants = $listeDesDiluants . " " . $nomDiluant; //On le concatène avec les autres noms
                }
            } else {
                $listeDesDiluants = "aucuns diluants";
            }

            if ($this->lAutres != []) {//On regarde si notre liste n'est pas vide
                $nbAutre = count($this->lAutres); //On compte le nombre d'éléments présents dans la liste des autres boissons
                $listeDesAutres = "";//On prepare le message a afficher

                for ($i = 0; $i <= $nbAutre - 1; $i++) { //pour chaque autres boissons
                    $nomAutre = $this->lAutres[$i]->getNomBoisson(); //on récupère son nom
                    $listeDesAutres = $listeDesAutres . " " . $nomAutre; //On le concatène avec les autres noms
                }
            } else {
                $listeDesAutres = "aucunes autres boissons";
            }

            $message = "La liste d'alcools contient : " . $listeDesAlcools . " ; la liste des diluants contient : " . $listeDesDiluants . " ; la liste des autres boissons contient : " . $listeDesAutres; //On récupére chaque liste de boissons et on les concatènes
            return $message;
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */

        /**
         * @brief Ajoute une boisson au stock et a la base de données
         * @param string nomFichier : Nom du fichier dans lequel on va recuperer les boissons à comparer
         * @param string nomBoisson : Nom de la boisson à ajouter
         * @param float quantite : Volume de la boisson à ajouter
         */
        function ajouterBoisson($nomFichier, $nomBoisson, $quantite)
        {
            //On ouvre et decode le fichier json
            $json_data = ouvrirJson($nomFichier);
            //On crée une nouvelle boisson avec le nom passé en paramètre
            $boissonAajouter = new Boisson($nomBoisson, 0, 0, 0);

            //Parcourss du json, pour chercher la boisson
            $boissonTrouve = false;
            $position = 0;
            while ($boissonTrouve != true &&  $position < count($json_data["Boisson"])) {
                //Si la boisson est déjà dans le fichier
                if ($json_data["Boisson"][$position]["nomBoisson"] == $boissonAajouter->getNomBoisson())
                {
                    $boissonAajouter->setTypeBoisson($json_data["Boisson"][$position]["typeBoisson"]);
                    $boissonAajouter->setQtBoissonInitiale($quantite);
                    $boissonAajouter->setQtBoissonEnCours($quantite);
                    $boissonTrouve = true;
                }
                else{
                    $position = $position + 1;
                }
            }

            //On recupere le type de la boisson
            $typeBoisson = $boissonAajouter->getTypeBoisson();

            //On regarde le type de la boisson
            switch ($typeBoisson) {
                case 1: //Si c'est le type 1 (alcool)
                    $this->setLAlcools($boissonAajouter); //on l'ajoute à la liste d'alcools
                    break;

                case 2: //Si c'est le type 2 (diluant)
                    $this->setLDiluants($boissonAajouter); //on l'ajoute à la liste de diluants
                    break;

                case 3: //Si c'est le type 3 (autre)
                    $this->setLAutres($boissonAajouter); //on l'ajoute à la liste de autres boissons
                    break;

                default: //Si aucun de ces cas ne sont possibles on indique l'erreur possible
                    break;
            }
        }

        /**
         * @brief Supprime une boisson du stock
         * @param string nomBoisson
         * @note Ne supprime pas la boisson du fichier json
         */
        function supprimerBoisson($nomBoisson)
        {
            //On verifie si la boisson est dans nos listes
            $boissonTrouve = false;
            $position = 0;
            while ($boissonTrouve != true &&  $position < count($this->lAlcools)) {
                //Si la boisson est dans la liste des alcools
                if ($nomBoisson == $this->lAlcools[$position]->getNomBoisson()) {
                    array_splice($this->lAlcools, $position, 1); //On supprime la boisson
                    $boissonTrouve = true;
                } else {
                    $position = $position + 1;
                }
            }

            $position = 0;
            while ($boissonTrouve != true &&  $position < count($this->lDiluants)) {
                //Si la boisson est dans la liste des diluants
                if ($nomBoisson == $this->lDiluants[$position]->getNomBoisson()) {
                    array_splice($this->lDiluants, $position, 1); //On supprime la boisson
                    $boissonTrouve = true;
                } else {
                    $position = $position + 1;
                }
            }

            $position = 0;
            while ($boissonTrouve != true &&  $position < count($this->lDiluants)) {
                //Si la boisson est dans la liste des diluants
                if ($nomBoisson == $this->lAutres[$position]->getNomBoisson()) {
                    array_splice($this->lAutres, $position, 1); //On supprime la boisson
                    $boissonTrouve = true;
                } else {
                    $position = $position + 1;
                }
            }

            if ($boissonTrouve == false) {
                echo "La boisson n'a pas été trouvée";
            }

        }

        /**
         * @brief Retourne la taille de la liste des alcools
         * @return int
         */
        function tailleAlcools(){
            return count($this->lAlcools);
        }

        /**
         * @brief Retourne la taille de la liste des diluants
         * @return int
         */
        function tailleDiluants(){
            return count($this->lDiluants);
        }

        /**
         * @brief Retourne la taille de la liste des autres boissons
         * @return int
         */
        public function tailleAutres(){
            return count($this->lAutres);
        }
    }
?>

