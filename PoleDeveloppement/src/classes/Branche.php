<?php
    /** 
     * @file Branche.php
     * @author @nicolasdelahaie <ndelahaie@iutbayonne.univ-pau.fr>
     * @version 3.0
     * @brief Classe branche representant une possiblite de recette
    */
    class Branche{
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $pRecette;  /** @var array Pile des recettes présents dans les noeuds precedents*/
        private $qtBranche; /** @var float Volume total de la branche*/
        private $qtValeur;  /** @var int Valeur totale de la branche*/

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Constructeur d'un objet Branche par défaut, par copie ou par paramètres
         * @param array 1 de la classe : pRecette
         * @param float 2 de la classe : qtBranche
         * @param int 2 de la classe : qtValeur
         * @todo ENLEVE LES CONSTYRUCTEURS PAR COPIE ET DEFAUT CAR IMPOSSIBLE A DOCUMENTER
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
        /** @return array pRecette*/
        function getPRecette (){return ($this->pRecette);}
        /** @return float qtBranche*/
        function getQtBranche (){return ($this->qtBranche);}  
        /** @return int qtValeur*/
        function getQtValeur (){return ($this->qtValeur);}     
        
        /* --------------------------------- SETTERS --------------------------------- */
        /**
         * @brief Set la pile de recettes
         * @param array p
         */
        function setPRecette ($p){$this->pRecette = $p;}  
        /**
         * @brief Set le volume total
         * @param float qtB
         */
        function setQtBranche ($qtB){$this->qtBranche = $qtB;}  
        /**
         * @brief Set la valeur totale
         * @param int qtV
         */
        function setQtValeur ($qtV){$this->qtValeur = $qtV;} 

        /* -------------------------------- TO STRING ------------------------------- */
        /**
         * @brief Traduit la branche en une chaine de caracteres de la forme branche(volume utilise : X, valeur totale : X, suite de cocktails : X - X - Z)
         * @return string caractere representant l objet
         */
        function toString(){
            $message = "Branche (volume utilise : $this->qtBranche, valeur totale : $this->qtValeur, suite de cocktails : ";

            $copiePile = $this->pRecette;
            while ($copiePile != array())
            {
                $message = $message.array_pop($copiePile)->toString()." <br><br>";
            }
            $message = $message.")";
            return($message);
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */

        /**
         * @brief Ajoute une recette a la branche
         * @param Recette recette a ajouter
         */
        function ajouterRecette($recette)
        {
            array_unshift($this->pRecette, $recette);
            $this->qtBranche += $recette->getQtRecette();
            $this->qtValeur += $recette->getValeur();
        }

        /**
         * @brief Supprime la derniere recette de la branche
         */
        function popRecette(){
            $recette = array_pop($this->pRecette);
            $this->qtBranche -= $recette->getQtRecette();
            $this->qtValeur -= $recette->getValeur();
        }

        /**
         * @brief Verifie si la branche est vide
         * @return true si la branche est vide, false sinon
         */
        function estVide()
        {
            return ($this->pRecette == array());
        }

        /**
         * @brief Retourne la taille de la pile
         * @return int taille de la pile
         */
        function taillePile()
        {
            return (count($this->pRecette));
        }

    }
?>

