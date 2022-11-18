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
            //Retourne la branche de la forme branche(volume utilise : X, valeur totale : X, suite de cocktails : X - X - Z)
            $message = "Branche (volume utilise : $this->qtBranche, valeur totale : $this->qtValeur, suite de cocktails : ";

            $copiePile = $this->pRecette;
            while ($copiePile != array())
            {
                $message = $message.array_pop($copiePile)->getNomRecette()." - ";
            }
            $message = $message.")";
            return($message);
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }
?>

