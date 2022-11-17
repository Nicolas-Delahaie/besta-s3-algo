<?php
    class Branche{
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        
        private $pRecette, $qtBranche, $qtValeur;

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        function __construct()
        {
            $nbArguments= func_num_args();
            $tabArguments=func_get_args();
            

            switch ($nbArguments) {
                case 0:
                    //Aucun parametres
                    $this->pRecette= array();
                    $this->qtBranche=0;
                    $this->qtValeur=0;
                    break;
                
                case 1:
                    //Constructeur par reference
                    $this->pRecette=$tabArguments[0]->pRecette;
                    $this->qtBranche=$tabArguments[0]->qtBranche;
                    $this->qtValeur=$tabArguments[0]->qtValeur;
                    break;
                
                case 3:
                    //Tous les parametres sont inscrits
                    $this->pRecette=$tabArguments[0];
                    $this->qtBranche=$tabArguments[1];
                    $this->qtValeur=$tabArguments[2];
                    break;

                default:
                    print("les parametres ne sont pas bon, les paramètres doivent etre soit nul, soit un objet de type Boisson, soit quatres parametres (nomBoisson, typeBoisson, qtBoissonInitiale, qtBoissonEnCours)");
                    break;
            }
        }
        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETTERS --------------------------------- */
        function getPRecette (){return ($this->pRecette);}
        function getQtBranche (){return ($this->qtBranche);}  
        function getQtValeur (){return ($this->qtValeur);}     
        
        /* --------------------------------- SETTERS --------------------------------- */
        function setPRecette ($p){$this->pRecette = p;}  
        function setQtBranche ($qtB){$this->qtBranche = qtB;}  
        function setQtValeur ($qtV){$this->qtValeur = qtV;} 

        /* -------------------------------- TO STRING ------------------------------- */
        function toString(){
            $message = "Je suis la branche consommant ".$this->qtBranche." L d'alcool et ayant pour valeur total ".$this->qtValeur.".<br>J'ai comme suite de cocktails : ";
            while ($this->pRecette != array())
            {
                $message = $message.array_pop($this->pRecette)." - ";
            }
            return($message);
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }

    
    $branche = new Branche(array("VODKA", "ANNANAS", "CACTUS"), 66, 911);
    print($branche->toString());
?>

