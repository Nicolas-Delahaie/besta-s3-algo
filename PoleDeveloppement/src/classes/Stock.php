<?php

    /** 
    *@author @alexandrePascal <apascal003@iutbayonne.univ-pau.fr>
    *@version 6.0
    */

    // require_once('boisson.php');

    /**
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

        /* -------------------------------- TO STRING ------------------------------- */

        function toString(){
            if ($this->lAlcools != []){ //On regarde si notre liste n'est pas vide
                $nbAlcools = count($this->lAlcools); //On compte le nombre d'éléments présents dans la liste des alcools
                $listeDesAlcools = ""; //On prepare le message a afficher

                for ($i = 0; $i <= $nbAlcools - 1; $i++){ //Pour chaque alcool
                    $nomAlcool= $this->lAlcools[$i]->getNomBoisson(); //On récupére son nom
                    $listeDesAlcools = $listeDesAlcools." ".$nomAlcool; //On le concatène avec les autres noms
                    }
                }

            else { //Si la liste des alcools est vide
                $listeDesAlcools = "aucuns alcools"; 
            }    
            
            if ($this->lDiluants != []){ //On regarde si notre liste n'est pas vide
                $nbDiluant = count($this->lDiluants); //On compte le nombre d'éléments présents dans la liste des diluants
                $listeDesDiluants = "";//On prepare le message a afficher

                for ($i = 0; $i <= $nbDiluant - 1; $i++){ //pour chaque diluants
                    $nomDiluant= $this->lDiluants[$i]->getNomBoisson();//On récupère son nom
                    $listeDesDiluants = $listeDesDiluants." ".$nomDiluant; //On le concatène avec les autres noms
                    }
                }
            else {
                $listeDesDiluants = "aucuns diluants";
            }    

            if ($this ->lAutres != []) {//On regarde si notre liste n'est pas vide
                $nbAutre = count($this->lAutres); //On compte le nombre d'éléments présents dans la liste des autres boissons
                $listeDesAutres = "";//On prepare le message a afficher
                
                for ($i = 0; $i <= $nbAutre - 1; $i++){ //pour chaque autres boissons
                    $nomAutre= $this->lAutres[$i]->getNomBoisson(); //on récupère son nom
                    $listeDesAutres = $listeDesAutres." ".$nomAutre; //On le concatène avec les autres noms
                    }
            }

            else {
                $listeDesAutres = "aucunes autres boissons";
            }

            $message= "La liste d'alcools contient : ". $listeDesAlcools . " ; la liste des diluants contient : ". $listeDesDiluants . " ; la liste des autres boissons contient : ". $listeDesAutres; //On récupére chaque liste de boissons et on les concatènes
            return $message;

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }
}

?>
