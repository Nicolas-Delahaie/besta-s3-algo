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
         * @brief A REMPLIR (pRecette)
         */
        private $pRecette;
        /**
         * @brief A REMPLIR (qtBranche)
         */
        private $qtBranche;
        /**
         * @brief A REMPLIR (qtValeur)
         */
        private $qtValeur;

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Constructeur par defaut, par copie ou avec parametres
         * @param attribut 1 de la classe : pRecette
         * @param attribut 2 de la classe : qtBranche
         * @param attribut 2 de la classe : qtValeur
         */
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
        /**
         * @return l'attribut 1 de la classe : pRecette
         */
        function getPRecette (){return ($this->pRecette);}
        /**
         * @return l'attribut 2 de la classe : qtBranche
         */
        function getQtBranche (){return ($this->qtBranche);}  
        /**
         * @return l'attribut 3 de la classe : qtValeur
         */
        function getQtValeur (){return ($this->qtValeur);}     
        
        /* --------------------------------- SETTERS --------------------------------- */
        /**
         * @brief set l'attribut 1 pRecette
         * @param pRecette
         */
        function setPRecette ($p){$this->pRecette = $p;}  
        /**
         * @brief set l'attribut 1 pRecette
         * @param qtBranche
         */
        function setQtBranche ($qtB){$this->qtBranche = $qtB;}  
        /**
         * @brief set l'attribut 1 pRecette
         * @param qtValeur
         */
        function setQtValeur ($qtV){$this->qtValeur = $qtV;} 

        /* -------------------------------- TO STRING ------------------------------- */
        /**
         * @brief Traduit la branche en une chaine de caracteres
         * @return Chaine de caractere representant l objet
         */
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

