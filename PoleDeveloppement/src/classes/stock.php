<?php

    include 'boisson.php';

    print("tu est dans la classe stock");

    class stock{

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $lAlcools;
        private $lDiluants;
        private $lAutre;

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        
        function __construct()
        {
            $lAlcools = array();
            $lDiluants = array();
            $lAutre = array();

            $nbArguments= func_num_args();
            $tabArguments=func_get_args(); 

            if ($nbArguments > 0) {
                
                for ($i = 0; $i <= $nbArguments; $i++) {
            
                    switch ($tabArguments[$i]->getTypeBoisson) {
                        case 1:
                            $this->setLAlcools($tabArguments[$i]);
                            break;
                        
                        case 2:
                            $this->setLDiluants($tabArguments[$i]);  
                            break;
                        
                        case 3:
                            $this->setLAutre($tabArguments[$i]);
                            break;
                        default:
                            print("les parametres ne sont pas bons, les paramètres doivent etre soit nuls, soit des objets de type boisson");
                            break;
                    }   
                }
            }

            else {
                $this->setLAlcools("");
                $this->setLDiluants("");
                $this->setLAutres("");
            }

            if ($nbArguments > 0) {
                for ($i = 0; $i <= $nbArguments; $i++) {
                    array_push($this->lAlcools, $tabArguments[$i]);
                    
                }
            }
    
        }

        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETEUR --------------------------------- */

        function getLAlcools (){
            return ($this->lAlcools);
        }        
        function getLDilants (){
            return ($this->lDiluants);
        }        
        function getLAutres (){
            return ($this->lAutres);
        }              

        /* --------------------------------- SETEUR --------------------------------- */

        function setLAlcools(){
            $nbArguments= func_num_args();
            $tabArguments=func_get_args(); 

            for ($i = 0; $i <= $nbArguments; $i++) {
                array_push($this->lAlcools, $nouvelAlcool[$i]);
            }
        }
        
        function setLDiluants($nouveauDiluant){
            $nbArguments= func_num_args();
            $tabArguments=func_get_args(); 

            for ($i = 0; $i <= $nbArguments; $i++) {
                array_push($this->lDiluants, $nouveauDiluant[$i]);
            }
        }

        function setLAutres($nouvelAutre){
            $nbArguments= func_num_args();
            $tabArguments=func_get_args(); 

            for ($i = 0; $i <= $nbArguments; $i++) {
                array_push($this->lAutre, $nouvelAutre[$i]);
            }
        }


        /* -------------------------------- TO STRING ------------------------------- */

        function toString(){
            $message="La liste d'alcools contient : ".$this->getAlcools().", la liste de diluants contient : ".$this->getLDilants().", la liste des autres boissons contient : ".$this->getLAutres();
            return($message); //pour afficher le message il faudra faire un print_r
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }

?>