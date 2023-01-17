<?php
    /**
     * @author @oiercesat <ocesat@iutbayonne.univ-pau.fr>
     * @version 2.0
     * @brief classe Boisson comportant un nom, un type, une quantité initiale et la quantité de boisson en cours
    */
    class Boisson{

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $nomBoisson;            //nom de la boisson
        private $typeBoisson;           //type de la boisson
        private $qtBoissonInitiale;     //quantité initiale de la boisson
        private $qtBoissonEnCours;      //quantité en cours/actuelle de la boisson

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        

        /**
         * @brief constructeur d'une Boisson 
         * @param string, int, int, int ou une boisson ou pas de paramètres 
         * @return Boisson
         */
        function __construct()
        {

            $nbArguments= func_num_args();      //Nombre de parametres recu par le constructeur
            $tabArguments=func_get_args();      //Stocke les parametre dans un tableau


            switch ($nbArguments) {

                // si le constructeur est par défaut
                case 0:
                    $this->nomBoisson="";
                    $this->typeBoisson=0;
                    $this->qtBoissonInitiale=0;
                    $this->qtBoissonEnCours=0;
                    break;
                
                // si le paramètre est une Boisson
                case 1:
                    $this->nomBoisson=$tabArguments[0]->nomBoisson;
                    $this->typeBoisson=$tabArguments[0]->typeBoisson;
                    $this->qtBoissonInitiale=$tabArguments[0]->qtBoissonInitiale;
                    $this->qtBoissonEnCours=$tabArguments[0]->qtBoissonEnCours;
        
                    break;
                
                // si les paramètres sont les attributs d'une boisson
                case 4:
                    $this->nomBoisson=$tabArguments[0];
                    $this->typeBoisson=$tabArguments[1];
                    $this->qtBoissonInitiale=$tabArguments[2];
                    $this->qtBoissonEnCours=$tabArguments[3];
                    
                    break;

                //si le nombre de paramètre n'est pas bon
                default:
                    print("les parametres ne sont pas bon, les paramètres doivent etre soit nul, soit un objet de type Boisson, soit quatres parametres (nomBoisson, typeBoisson, qtBoissonInitiale, qtBoissonEnCours)");
                    break;
            }   
        }

        /* -------------------------------------------------------------------------- */
        /*                              METHODES USUELLES                             */
        /* -------------------------------------------------------------------------- */

        /* --------------------------------- GETEUR --------------------------------- */

        /**
         * @brief retourne le nom de la boisson
         * @return string 
         */
        function getNomBoisson (){
            return ($this->nomBoisson);
        }      
        
        /**
         * @brief retourne le type de la boisson
         * @return int 
         */
        function getTypeBoisson (){
            return ($this->typeBoisson);
        }        

        /**
         * @brief retourne la quantité initiale de la boisson
         * @return int
         */
        function getQtBoissonInitiale (){
            return ($this->qtBoissonInitiale);
        }      
        
        /**
         * @brief retourne quantité en cours de la boisson
         * @return int
         */
        function getQtBoissonEnCours (){
            return ($this->qtBoissonEnCours);
        }        

        /* --------------------------------- SETEUR --------------------------------- */

        /**
         * @brief permet de modifier l'attribut nomBoisson
         * @param string nouveauNomBoisson
         */
        function setNomBoisson($nouveauNomBoisson){
            $this->nomBoisson=$nouveauNomBoisson;
        }

        /**
         * @brief permet de modifier l'attribut typeBoisson
         * @param int nouveauTypeBoisson
         */
        function setTypeBoisson($nouveauTypeBoisson){
            $this->typeBoisson=$nouveauTypeBoisson;
        }

        /**
         * @brief permet de modifier l'attribut qtBoissonInitiale
         * @param int nouvelleQtBoissonInitiale
         */
        function setQtBoissonInitiale($nouvelleQtBoissonInitiale){
            $this->qtBoissonInitiale=$nouvelleQtBoissonInitiale;
        }

        /**
         * @brief permet de modifier l'attribut qtBoissonEnCours
         * @param int nouvelleQtBoissonEnCours
         */
        function setQtBoissonEnCours($nouvelleQtBoissonEnCours){
            $this->qtBoissonEnCours=$nouvelleQtBoissonEnCours;
        }

        /* -------------------------------- TO STRING ------------------------------- */


        /**
         * @brief retourne un message comportant les spécifiquations de l'objet Boisson 
         * @return string message 
         */
        function toString(){
            $message="Le nom de la boisson est : ".$this->getNomBoisson().", le type de la boisson est : ".$this->getTypeBoisson().", la quantité initiale est : ".$this->getQtBoissonInitiale().", la quantité de boisson en cours est : ".$this->getQtBoissonEnCours();
            return($message);
        }

        /* -------------------------------------------------------------------------- */
        /*                            METHODES SPECIFIQUES                            */
        /* -------------------------------------------------------------------------- */
    }

?>
