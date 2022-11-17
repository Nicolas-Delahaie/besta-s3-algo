<?php
    class Boisson{

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $nomBoisson;
        private $qtBoissonInitiale;
        private $typeBoisson;
        private $qtBoissonEnCours;

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        
        function __construct()
        {
            $nbArguments= func_num_args();
            $tabArguments=func_get_args();

            switch ($nbArguments) {
                case 0:
                    $this->nomBoisson="";
                    $this->typeBoisson=0;
                    $this->qtBoissonInitiale=0;
                    $this->qtBoissonEnCours=0;
                    break;
                
                case 1:
                    $this->nomBoisson=$tabArguments[0]->nomBoisson;
                    $this->typeBoisson=$tabArguments[0]->typeBoisson;
                    $this->qtBoissonInitiale=$tabArguments[0]->qtBoissonInitiale;
                    $this->qtBoissonEnCours=$tabArguments[0]->qtBoissonEnCours;
                    
                    break;
                
                case 4:
                    $this->nomBoisson=$tabArguments[0];
                    $this->typeBoisson=$tabArguments[1];
                    $this->qtBoissonInitiale=$tabArguments[2];
                    $this->qtBoissonEnCours=$tabArguments[3];
                    
                    break;
                default:
                    print("les parametres ne sont pas bon, les paramètres doivent etre soit nul, soit un objet de type Boisson, soit quatres parametres (nomBoisson, typeBoisson, qtBoissonInitiale, qtBoissonEnCours)");
                    break;
            }   
        }

        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETEUR --------------------------------- */

        function getNomBoisson (){
            return ($this->nomBoisson);
        }        
        function getTypeBoisson (){
            return ($this->typeBoisson);
        }        
        function getQtBoissonInitiale (){
            return ($this->qtBoissonInitiale);
        }        
        function getQtBoissonEnCours (){
            return ($this->qtBoissonEnCours);
        }        

        /* --------------------------------- SETEUR --------------------------------- */

        function setNomBoisson($nouveauNomBoisson){
            $this->nomBoisson=$nouveauNomBoisson;
        }
        function setTypeBoisson($nouveauTypeBoisson){
            $this->typeBoisson=$nouveauTypeBoisson;
        }
        function setQtBoissonInitiale($nouvelleQtBoissonInitiale){
            $this->qtBoissonInitiale=$nouvelleQtBoissonInitiale;
        }
        function setQtBoissonEnCours($nouvelleQtBoissonEnCours){
            $this->qtBoissonEnCours=$nouvelleQtBoissonEnCours;
        }

        /* -------------------------------- TO STRING ------------------------------- */

        function toString(){
            $message="Le nom de la boisson est : ".$this->getNomBoisson().", le type de la boisson est : ".$this->getTypeBoisson().", la quantité initiale est : ".$this->getQtBoissonInitiale().", la quantité de boisson en cours est : ".$this->getQtBoissonEnCours();
            return($message);
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }

?>
