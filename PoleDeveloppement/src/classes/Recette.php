<?php
    include("Boisson.php");

    class Recette 
    {

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */

        private $nomRecette;
        private $alcool;

        private $diluant;

        private $qtRecette;
        
        private $qtAlcool;

        private $qtDiluant;

        private $valeur;

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */

        function __construct()
        {
            $nbArguments = func_num_args();
            $tabArguments = func_get_args();

            switch ($nbArguments) {

                case 0:
                    $this->nomRecette="";
                    $this->alcool=null;
                    $this->diluant=null;
                    $this->qtRecette=0;
                    $this->qtAlcool=0;
                    $this->qtDiluant=0;
                    $this->valeur=0;
                    break;
                
                    case 1:
                        $this->nomRecette=$tabArguments[0]->getNomRecette();
                        $this->alcool=$tabArguments[0]->gatAlcool();
                        $this->diluant=$tabArguments[0]->getDiluant();
                        $this->qtRecette=$tabArguments[0]->getQtRecette();
                        $this->qtAlcool=$tabArguments[0]->getQtAlcool();
                        $this->qtDiluant=$tabArguments[0]->getQtDiluant();
                        $this->valeur=$tabArguments[0]->getValeur();
                        break;

                    case 7:
                        $this->nomRecette=$tabArguments[0];
                        $this->alcool=$tabArguments[1];
                        $this->diluant=$tabArguments[2];
                        $this->qtRecette=$tabArguments[3];
                        $this->qtAlcool=$tabArguments[4];
                        $this->qtDiluant=$tabArguments[5];
                        $this->valeur=$tabArguments[6];
                        break;

                default:
                    print("les parametres ne sont pas bon, les paramètres doivent etre soit nul, soit un objet de type Recette, soit quatres parametres (nomRecette, alcool, diluant, qtRecette, qtAlcool, qtDiluant, valeur)");
                    break;
            }
        }

        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETEURS -------------------------------- */

        function getNomRecette(){
            return ($this->nomRecette);
        }
        function getAlcool(){
            return ($this->alcool);
        }
        function getDiluant(){
            return ($this->diluant);
        }
        function getQtRecette(){
            return ($this->qtRecette);
        }
        function getQtAlcool(){
            return ($this->qtAlcool);
        }
        function getQtDiluant(){
            return ($this->qtDiluant);
        }
        function getValeur(){
            return ($this->valeur);
        }

        /* --------------------------------- SETEUR --------------------------------- */

        function setNomRecette($nouveauNomRecette){
            $this->nomRecette=$nouveauNomRecette;
        }
        function setAlcool($nouvelAlcool){
            $this->alcool=$nouvelAlcool;
        }
        function setDiluant($nouveauDiluant){
            $this->diluant=$nouveauDiluant;
        }
        function setQtRecette($nouvelleQtRecette){
            $this->qtRecette=$nouvelleQtRecette;
        }
        function setQtAlcool($nouvelleQtAlcool){
            $this->qtAlcool=$nouvelleQtAlcool;
        }
        function setQtDiluant($nouvelleQtDiluant){
            $this->qtDiluant=$nouvelleQtDiluant;
        }
        function setValeur($nouvelleValeur){
            $this->valeur=$nouvelleValeur;
        }

        /* -------------------------------- TO STRING -------------------------------- */

        function toString(){
            $message = "Le nom de la recette est : ".$this->getNomRecette().", l'alcool de cette recette est : ".$this->getAlcool()->toString().", le diluant de cette recette est : ".$this->getDiluant()->toString().", la quantite de cette recette est de : ".$this->getQtRecette()." L, la quantite d'alcool est de : ".$this->getQtAlcool()." L, la quantite de diluant est de : ".$this->getQtDiluant()." L et la valeur de cette recette est de : ".$this->getValeur();
            return ($message);
        }
    }
    
?>