<?php
    /** 
     * @author @nicolasdelahaie <ndelahaie@iutbayonne.univ-pau.fr>
     * @version ${1:1.0.0
     */
    
    /**
     * @brief Classe branche representant une possiblite de cocktail
     */
    class Branche{
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Pile des cocktails fabriqués dans la branche entière
         */
        private $pCocktails;
        /**
         * @brief Volume total des cocktails de la branche entière
         */
        private $volumeTotal;
        /**
         * @brief Total des valeurs de la branche entière
         */
        private $valeurTotale;
        
        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Constructeur par defaut, par copie ou avec parametres
         * @param attribut 1 de la classe : pCocktails
         * @param attribut 2 de la classe : volumeTotal
         * @param attribut 2 de la classe : valeurTotale
         */
        function __construct()
        {
            $nbArguments= func_num_args();
            $tabArguments=func_get_args();

            switch ($nbArguments) {
                case 0:
                    //Aucun parametres
                    $this->pCocktails= array();
                    $this->volumeTotal=0;
                    $this->valeurTotale=0;
                    break;
                
                case 1:
                    //Constructeur par reference
                    $this->pCocktails=$tabArguments[0]->pCocktails;
                    $this->volumeTotal=$tabArguments[0]->volumeTotal;
                    $this->valeurTotale=$tabArguments[0]->valeurTotale;
                    break;
                
                case 3:
                    //Tous les parametres sont inscrits
                    $this->pCocktails=$tabArguments[0];
                    $this->volumeTotal=$tabArguments[1];
                    $this->valeurTotale=$tabArguments[2];
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
        /**
         * @return pCocktails
         */
        function getPCocktails (){return ($this->pCocktails);}
        /**
         * @return volumeTotal
         */
        function getVolumeTotal (){return ($this->volumeTotal);}  
        /**
         * @return valeurTotale
         */
        function getValeurTotale (){return ($this->valeurTotale);}     
        
        
        
        /* --------------------------------- SETTERS --------------------------------- */
        /**
         * @brief Set la pile des cocktails fabriqués dans la branche entière
         * @param pCocktails
         */
        function setpCocktails ($p){$this->pCocktails = $p;}  
        /**
         * @brief Set le volume total des cocktails de la branche entière
         * @param volumeTotal
         */
        function setVolumeTotal ($qtB){$this->volumeTotal = $qtB;}  
        /**
         * @brief Set le total des valeurs de la branche entière
         * @param valeurTotale
         */
        function setValeurTotale ($qtV){$this->valeurTotale = $qtV;} 

        /* -------------------------------- TO STRING ------------------------------- */
        /**
         * @brief Traduit la branche en une chaine de caracteres
         * @return String
         */
        function toString(){
            //Retourne la branche de la forme branche(volume utilise : X, valeur totale : X, suite de cocktails : X - X - Z)
            $message = "Branche (volume utilise : $this->volumeTotal, valeur totale : $this->valeurTotale, suite de cocktails : (";

            
            $copiePile = $this->pCocktails;
            
            if  (!empty($copiePile)){
                $message .= array_pop($copiePile)->getNomRecette();
                while ($copiePile != array())
                {
                    //Tant que la pile n'est pas vide
                    $message .= ", ".array_pop($copiePile)->getNomRecette();
                }
            }
            

    
            $message = $message."))";
            return($message);
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }
?>

