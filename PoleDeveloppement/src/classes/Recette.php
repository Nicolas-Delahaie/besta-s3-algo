<?php
    /**
     * @file Recette.php
     * @author @oiercesat <ocesat@iutbayonne.univ-pau.fr>
     * @version 3.0
     * @brief Classe Recette representant une combinaison de 2 boissons (un alcool et un diluant) 
    */
    class Recette 
    {
        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $nomRecette; /** @var string Nom de la recette*/   
        private $alcool;     /** @var Boisson Alcool associé à la recette*/
        private $diluant;    /** @var Boisson Diluant associé à la recette*/
        private $qtRecette;  /** @var float Volume en litres de la recette*/
        private $qtAlcool;   /** @var float Volume d'alcool présent dans la recette*/ 
        private $qtDiluant;  /** @var float Volume de diluant présent dans la recette*/
        private $valeur;     /** @var int Valeur de la recette*/    

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */

        /**
         * @brief Constructeur d'un objet Recette par défaut, par copie ou par paramètres
         * @param string nomRecette (par parametres) ou Recette (objet a copier)
         * @param Boisson alcool (par parametres)
         * @param Boisson diluant (par parametres)
         * @param float qtRecette (par parametres)
         * @param float qtAlcool (par parametres)
         * @param float qtDiluant (par parametres)
         * @param int valeur (par parametres)
         */
        function __construct()
        {
            $nbArguments = func_num_args();         //Nombre de paramètres reçu par le constructeur
            $tabArguments = func_get_args();        //Stocke les paramètres dans un tableau

            switch ($nbArguments) {
                //si le constructeur est par défaut
                case 0:
                    $this->nomRecette="";
                    $this->alcool=null;
                    $this->diluant=null;
                    $this->qtRecette=0;
                    $this->qtAlcool=0;
                    $this->qtDiluant=0;
                    $this->valeur=0;
                    break;
                
                //si le constructeur reçoit en paramètre un objet de type Recette
                case 1:
                    $this->nomRecette=$tabArguments[0]->getNomRecette();
                    $this->alcool=$tabArguments[0]->gatAlcool();
                    $this->diluant=$tabArguments[0]->getDiluant();
                    $this->qtRecette=$tabArguments[0]->getQtRecette();
                    $this->qtAlcool=$tabArguments[0]->getQtAlcool();
                    $this->qtDiluant=$tabArguments[0]->getQtDiluant();
                    $this->valeur=$tabArguments[0]->getValeur();
                    break;

                //si l'objet reçoit les 7 paramètres pour le configurer
                case 7:
                    $this->nomRecette=$tabArguments[0];
                    $this->alcool=$tabArguments[1];
                    $this->diluant=$tabArguments[2];
                    $this->qtRecette=$tabArguments[3];
                    $this->qtAlcool=$tabArguments[4];
                    $this->qtDiluant=$tabArguments[5];
                    $this->valeur=$tabArguments[6];
                    break;

                //si les paramètres reçu ne sont pas bon
                default:
                    print("les parametres ne sont pas bon, les paramètres doivent etre soit nul, soit un objet de type Recette, soit quatres parametres (nomRecette, alcool, diluant, qtRecette, qtAlcool, qtDiluant, valeur)");
                    break;
            }
        }

        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETEURS -------------------------------- */
        /**
         * @brief Retourne le nom de la recette
         * @return string 
         */
        function getNomRecette(){
            return ($this->nomRecette);
        }

        /**
         * @brief Retourne l'alcool associé à la recette 
         * @return Boisson 
         */
        function getAlcool(){
            return ($this->alcool);
        }

        /**
         * @brief Retourne le diluant associé à la recette
         * @return Boisson 
         */
        function getDiluant(){
            return ($this->diluant);
        }

        /**
         * @brief Retourne le volume de la recette
         * @return float  
         */
        function getQtRecette(){
            return ($this->qtRecette);
        }

        /**
         * @brief Retourne le volume d'alcool présent dans la recette
         * @return float  
         */
        function getQtAlcool(){
            return ($this->qtAlcool);
        }

        /**
         * @brief Retourne le volume de diluant présent dans la recette
         * @return float  
         */
        function getQtDiluant(){
            return ($this->qtDiluant);
        }

        /**
         * @brief Retourne la valeur de la recette
         * @return int  
         */
        function getValeur(){
            return ($this->valeur);
        }

        /* --------------------------------- SETEUR --------------------------------- */

        /**
         * @brief Definit l'attribut nomRecette
         * @param string nouveauNomRecette
         */
        function setNomRecette($nouveauNomRecette){
            $this->nomRecette=$nouveauNomRecette;
        }

        /**
         * @brief Definit l'attribut alcool
         * @param Boisson nouvelAlcool
         */
        function setAlcool($nouvelAlcool){
            $this->alcool=$nouvelAlcool;
        }

        /**
         * @brief Definit l'attribut diluant
         * @param Boisson nouveauDiluant
         */
        function setDiluant($nouveauDiluant){
            $this->diluant=$nouveauDiluant;
        }

        /**
         * @brief Definit l'attribut qtRecette
         * @param float nouvelleQtRecette
         */
        function setQtRecette($nouvelleQtRecette){
            $this->qtRecette=$nouvelleQtRecette;
        }

        /**
         * @brief Definit l'attribut qtAlcool
         * @param float nouvelleQtAlcool
         */
        function setQtAlcool($nouvelleQtAlcool){
            $this->qtAlcool=$nouvelleQtAlcool;
        }

        /**
         * @brief Definit l'attribut qtDiluant
         * @param float nouvelleQtDiluant
         */
        function setQtDiluant($nouvelleQtDiluant){
            $this->qtDiluant=$nouvelleQtDiluant;
        }

        /**
         * @brief Modifie l'attribut valeur
         * @param int nouvelleValeur
         */
        function setValeur($nouvelleValeur){
            $this->valeur=$nouvelleValeur;
        }

        /* -------------------------------- TO STRING -------------------------------- */

        /**
         * @brief Retourne un message recapitulant la recette
         * @return string
         */
        function toString(){
            $message = "Le nom de la recette est : ".$this->getNomRecette().", l'alcool de cette recette est : ".$this->getAlcool()->toString().", le diluant de cette recette est : ".$this->getDiluant()->toString().", la quantite de cette recette est de : ".$this->getQtRecette()." L, la quantite d'alcool est de : ".$this->getQtAlcool()." L, la quantite de diluant est de : ".$this->getQtDiluant()." L et la valeur de cette recette est de : ".$this->getValeur();
            return ($message);
        }
    }
    
?>