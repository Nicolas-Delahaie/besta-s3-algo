<?php

    /** 
     * @author @alexandrePascal <apascal003@iutbayonne.univ-pau.fr>
     * @version 6.0
     * @brief Classe Stock comportant une liste d'alcools, une liste de diluants et une 
    */
    class Stock{
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $lAlcools = array(); // Création de la liste d'alcools
        private $lDiluants = array(); // Création de la liste de diluants
        private $lAutres = array(); // Création de la liste des autres boissons

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        
        /**
         * @brief
         * @param
         * @warning Si le stock est construit avec une seule boisson, il y aura un problème car le code ne sais pas différentier entre 1 paramètre étant un object boisson, ou un autre étant un objet stock (problème de constructeur par copie). On admet donc que le cas d'une seul boisson n'existera jamais (pour 1 recette il faut au moins 2 boissons)
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

        function getLAlcools (){
            return $this->lAlcools;
        }    

        function getLDiluants (){
            return $this -> lDiluants;
        }        
        function getLAutres (){       
            return $this -> lAutres;
        }              

        /* --------------------------------- SETEUR --------------------------------- */

        function setLAlcools($nouveauAlcool){ 
            array_push($this->lAlcools, $nouveauAlcool); //On ajoute a la liste d'alcools, l'alcool passée en paramètre
        }
        function setLDiluants($nouveauDiluant){
            array_push($this->lDiluants, $nouveauDiluant);//On ajoute a la liste de diluants, le diluant passée en paramètre
        }
        function setLAutres($nouveauAutre){
            array_push($this->lAutres, $nouveauAutre);//On ajoute a la liste des autres boissons, la boisson passée en paramètre
        }

        /* --------------------------------- SUPPRESSION --------------------------------- */

        function supprLAlcools($alcool){
            unset($this->lAlcools[array_search($alcool, $this->lAlcools)]);//Supprime la boisson alcool passée en paramètre
        }

        function supprLDiluants($diluant){
            unset($this->lDiluants[array_search($diluant, $this->lDiluants)]);//Supprime la boisson diluant passée en paramètre
        }

        function supprLAutres($autre){
            unset($this->lAutres[array_search($autre, $this->lAutres)]); //Supprime la boisson autre passée en paramètre
        }

        /* -------------------------------- TO STRING ------------------------------- */

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

        public function ajouterBoisson($nomFichier, $nomBoisson, $quantite)
        /**
         * @brief: Cette méthode permet d'ajouter une boisson à la liste des boissons
         * @param: $nomFichier: le nom du fichier dans lequel on va recuperer les boissons à comparer
         * @param: $nomBoisson: le nom de la boisson à ajouter
         * @param: $quantite: la quantité de la boisson à ajouter
         * @return: void
         */
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

        public function supprimerBoisson($nomBoisson)
            /**
             * @brief: Cette méthode permet de supprimer une boisson du stock
             * @param: $nomBoisson: le nom de la boisson à supprimer
             * @return: void
             * @note: Cette méthode ne supprime pas la boisson du fichier json
             */
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
         * @brief: Retourne la taille de la liste des alcools
         * @return int
         */
        public function tailleAlcools(){
            return count($this->lAlcools);
        }

        /**
         * @brief: Retourne la taille de la liste des diluants
         * @return int
         */
        public function tailleDiluants(){
            return count($this->lDiluants);
        }

        /**
         * @brief: Retourne la taille de la liste des autres boissons
         * @return int
         */
        public function tailleAutres(){
            return count($this->lAutres);
        }
    }
?>

