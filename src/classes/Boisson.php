<?php
    /**
     * @file Boisson.php
     * @version 2.0
     * @brief Classe Boisson representant une boisson (permettant de fabriquer un cocktail)
    */
    class Boisson{

        /* -------------------------------------------------------------------------- */
        /*                                  ATTRIBUTS                                 */
        /* -------------------------------------------------------------------------- */
        private $nomBoisson;         /** @var string Nom de la boisson*/
        private $typeBoisson;        /** @var int Type de la boisson (alcool, soft, autre)*/
        private $qtBoissonInitiale;  /** @var float Volume initial de la boisson*/
        private $qtBoissonEnCours;   /** @var float Volume en cours de la boisson*/

        /* -------------------------------------------------------------------------- */
        /*                                CONSTRUCTEUR                                */
        /* -------------------------------------------------------------------------- */
        /**
         * @brief Constructeur d'un objet Boisson par défaut, par copie ou par paramètres
         * @param string nomBoisson (par parametres) ou Boisson (objet a copier)
         * @param int typeBoisson (par parametres)
         * @param int qtBoissonInitiale (par parametres)
         * @param int qtBoissonEnCours (par parametres)
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
        /* --------------------------------- GETEUR --------------------------------- */
        /**
         * @brief Renvoie le nom de la boisson
         * @return string 
         */
        function getNomBoisson (){
            return ($this->nomBoisson);
        }      
        /**
         * @brief Renvoie le type de la boisson
         * @return int 
         */
        function getTypeBoisson (){
            return ($this->typeBoisson);
        }        
        /**
         * @brief Renvoie le volume initial de la boisson
         * @return float
         */
        function getQtBoissonInitiale (){
            return ($this->qtBoissonInitiale);
        }      
        /**
         * @brief Renvoie le volume en cours de la boisson
         * @return float
         */
        function getQtBoissonEnCours (){
            return ($this->qtBoissonEnCours);
        }        

        /* --------------------------------- SETEUR --------------------------------- */
        /**
         * @brief Permet de modifier l'attribut nomBoisson
         * @param string nouveauNomBoisson
         */
        function setNomBoisson($nouveauNomBoisson){
            $this->nomBoisson=$nouveauNomBoisson;
        }
        /**
         * @brief Permet de modifier l'attribut typeBoisson
         * @param int nouveauTypeBoisson
         */
        function setTypeBoisson($nouveauTypeBoisson){
            $this->typeBoisson=$nouveauTypeBoisson;
        }
        /**
         * @brief Permet de modifier l'attribut qtBoissonInitiale
         * @param float nouvelleQtBoissonInitiale
         */
        function setQtBoissonInitiale($nouvelleQtBoissonInitiale){
            $this->qtBoissonInitiale=$nouvelleQtBoissonInitiale;
        }
        /**
         * @brief Permet de modifier l'attribut qtBoissonEnCours
         * @param float nouvelleQtBoissonEnCours
         */
        function setQtBoissonEnCours($nouvelleQtBoissonEnCours){
            $this->qtBoissonEnCours=$nouvelleQtBoissonEnCours;
        }

        /* -------------------------------- TO STRING ------------------------------- */
        /**
         * @brief Retourne un message recapitulant la Boisson
         * @return string
         */
        function toString(){
            $message="Le nom de la boisson est : ".$this->getNomBoisson().", le type de la boisson est : ".$this->getTypeBoisson().", la quantité initiale est : ".$this->getQtBoissonInitiale().", la quantité de boisson en cours est : ".$this->getQtBoissonEnCours();
            return($message);
        }
    }
?>
