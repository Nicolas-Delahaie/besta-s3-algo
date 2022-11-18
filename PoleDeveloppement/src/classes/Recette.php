<?php
    /**
     *@author @oiercesat <ocesat@iutbayonne.univ-pau.fr>
     *@version ${1:1.0.0
    */
    
    /**
     * @brief classe Recette comportant un nom, un alcool, un diluant, une quantité de recette, la quantité d'alcool présent dans la recette, la quantité de diluant présent dans la recette et la valeur de la recette
     */
    class Recette 
    {

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */

        private $nomRecette;        //nom de la recette
        private $alcool;            //alcool associé à la recette

        private $diluant;           //diluant associé à la recette

        private $qtRecette;         //quantité en litres de la recette 
        
        private $qtAlcool;          //quantité d'alcool présent dans la recette 

        private $qtDiluant;         //quantité de diluant présent dans la recette 

        private $valeur;            //valeur de la recette 

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */

        /**
         * @brief constructeur d'une recette 
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