<?php
    /** 
     * @file Branche.php
     * @version 3.0
     * @brief Classe Branche representant une possiblite de recette
    */
    class Branche{
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $pRecette;  /** @var array Pile des recettes présentes dans l'arbre*/
        private $qtBranche; /** @var float Volume total de la branche*/
        private $qtValeur;  /** @var int Valeur totale de la branche*/

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Constructeur d'un objet Branche par défaut, par copie ou par paramètres
         * @param array pRecette (par parametres) ou Branche (objet a copier)
         * @param float qtBranche (par parametres)
         * @param int qtValeur (par parametres)
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
         * @brief Renvoie la pile de recettes présentes dans l'arbre
         * @return array
        */
        function getPRecette (){return ($this->pRecette);}
        /** 
         * @brief Renvoie le volume total de la branche
         * @return float
        */
        function getQtBranche (){return ($this->qtBranche);}  
        /** 
         * @brief Renvoie la valeur totale de la branche
         * @return float
        */
        function getQtValeur (){return ($this->qtValeur);}     
        
        /* --------------------------------- SETTERS --------------------------------- */
        /**
         * @brief Permet de modifier l'attribut pRecette
         * @param array p
         */
        function setPRecette ($p){$this->pRecette = $p;}  
        /**
         * @brief Permet de modifier l'attribut qtBranche
         * @param float qtB
         */
        function setQtBranche ($qtB){$this->qtBranche = $qtB;}  
        /**
         * @brief Permet de modifier l'attribut qtValeur
         * @param int qtV
         */
        function setQtValeur ($qtV){$this->qtValeur = $qtV;} 

        /* -------------------------------- TO STRING ------------------------------- */
        /**
         * @brief Retourne un message recapitulant la branche de la forme branche(volume utilise : X, valeur totale : X, suite de cocktails : X - X - Z)
         * @return string
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
         * @param Recette recette
         */
        function ajouterRecette($recette)
        {
            array_unshift($this->pRecette, $recette);
            $this->qtBranche += $recette->getQtRecette();
            $this->qtValeur += $recette->getValeur();
        }

        /**
         * @brief Depile la dernière recette de la branche
         */
        function popRecette(){
            $recette = array_pop($this->pRecette);
            $this->qtBranche -= $recette->getQtRecette();
            $this->qtValeur -= $recette->getValeur();
        }

        /**
         * @brief Indique si la branche est vide
         * @return boolean
         */
        function estVide()
        {
            return ($this->pRecette == array());
        }

        /**
         * @brief Retourne la taille de la pile
         * @return int
         */
        function taillePile()
        {
            return (count($this->pRecette));
        }

    }
?>

