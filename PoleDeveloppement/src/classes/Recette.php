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
         * Summary of __construct
         * @brief Constructeur d'un objet Recette par défaut, par copie ou par paramètres
         * @param string 1 de la classe : nomRecette
         * @param Boisson 2 de la classe : alcool
         * @param Boisson 3 de la classe : diluant
         * @param int 4 de la classe : qtRecette
         * @param int 5 de la classe : qtAlcool
         * @param int 6 de la classe : qtDiluant
         * @param int 7 de la classe : valeur
         * @todo ENLEVE LES CONSTYRUCTEURS PAR COPIE ET DEFAUT CAR IMPOSSIBLE A DOCUMENTER
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
         * @brief retourne le nom de la recette
         * @return string 
         */
        function getNomRecette(){
            return ($this->nomRecette);
        }

        /**
         * @brief retourne l'alcool de la recette 
         * @return Boisson 
         */
        function getAlcool(){
            return ($this->alcool);
        }

        /**
         * @brief retourne lle diluant de la recette
         * @return Boisson 
         */
        function getDiluant(){
            return ($this->diluant);
        }

        /**
         * @brief retourne la quantité de la recette
         * @return float  
         */
        function getQtRecette(){
            return ($this->qtRecette);
        }

        /**
         * @brief retourne la quantité d'alcool de la recette
         * @return float  
         */
        function getQtAlcool(){
            return ($this->qtAlcool);
        }

        /**
         * @brief retourne la quantité de diluant de la recette
         * @return float  
         */
        function getQtDiluant(){
            return ($this->qtDiluant);
        }

        /**
         * @brief retourne la valeur de la recette
         * @return float  
         */
        function getValeur(){
            return ($this->valeur);
        }

        /* --------------------------------- SETEUR --------------------------------- */

        /**
         * @brief permet de modifier l'attribut nomRecette
         * @param string nouveauNomRecette
         */
        function setNomRecette($nouveauNomRecette){
            $this->nomRecette=$nouveauNomRecette;
        }

        /**
         * @brief permet de modifier l'attribut alcool
         * @param string nouvelAlcool
         */
        function setAlcool($nouvelAlcool){
            $this->alcool=$nouvelAlcool;
        }

        /**
         * @brief permet de modifier l'attribut diluant
         * @param string nouveauDiluant
         */
        function setDiluant($nouveauDiluant){
            $this->diluant=$nouveauDiluant;
        }

        /**
         * @brief permet de modifier l'attribut qtRecette
         * @param string nouvelleQtRecette
         */
        function setQtRecette($nouvelleQtRecette){
            $this->qtRecette=$nouvelleQtRecette;
        }

        /**
         * @brief permet de modifier l'attribut qtAlcool
         * @param string nouvelleQtAlcool
         */
        function setQtAlcool($nouvelleQtAlcool){
            $this->qtAlcool=$nouvelleQtAlcool;
        }

        /**
         * @brief permet de modifier l'attribut qtDiluant
         * @param string nouvelleQtDiluant
         */
        function setQtDiluant($nouvelleQtDiluant){
            $this->qtDiluant=$nouvelleQtDiluant;
        }

        /**
         * @brief permet de modifier l'attribut valeur
         * @param int nouvelleValeur
         */
        function setValeur($nouvelleValeur){
            $this->valeur=$nouvelleValeur;
        }

        /* -------------------------------- TO STRING -------------------------------- */

        /**
         * @brief retourne un message comportant les spécifiquations de l'objet Recette 
         * @return string message 
         */
        function toString(){
            $message = "Le nom de la recette est : ".$this->getNomRecette().", l'alcool de cette recette est : ".$this->getAlcool()->toString().", le diluant de cette recette est : ".$this->getDiluant()->toString().", la quantite de cette recette est de : ".$this->getQtRecette()." L, la quantite d'alcool est de : ".$this->getQtAlcool()." L, la quantite de diluant est de : ".$this->getQtDiluant()." L et la valeur de cette recette est de : ".$this->getValeur();
            return ($message);
        }
    }
    
?>