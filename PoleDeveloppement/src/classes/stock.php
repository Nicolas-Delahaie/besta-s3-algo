<?php

    include 'boisson.php';

    print("tu est dans la classe stock");

    class stock{

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $lAlcools;
        private $lDiluants;
        private $lAutres;

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        
        function __construct()
        {
            $lAlcools = array();
            $lDiluants = array();
            $lAutres = array();

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
                            $this->setLAutres($tabArguments[$i]);
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
        function getLDiluants (){
            return ($this->lDiluants);
        }        
        function getLAutres (){
            return ($this->lAutres);
        }              

        /* --------------------------------- SETEUR --------------------------------- */

        function setLAlcools($nouveauAlcool){
                array_push($this->lAlcools, $nouveauAlcool);
        }
        
        function setLDiluants($nouveauDiluant){
                array_push($this->lDiluants, $nouveauDiluant);
        }

        function setLAutres($nouveauAutre){
                array_push($this->lAutres, $nouveauAutre);
        }


        /* -------------------------------- TO STRING ------------------------------- */

        function toString(){
            $message="La liste d'alcools contient : ".$this->getLAlcools().", la liste de diluants contient : ".$this->getLDiluants().", la liste des autres boissons contient : ".$this->getLAutres();
            return($message); //pour afficher le message il faudra faire un print_r
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }

?>