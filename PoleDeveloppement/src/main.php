<html>

<body>
    <form action="main.php" method="POST">
        <p>Insérez le nom de la recette </p>
        <input type="text" name="nomBoisson" id="nomBoisson">
        <p>Insérez la quantité de votre boisson</p>
        <input type="number" name="qtBoisson" value="qtBoisson">
        <br>
        <input type="submit" value="Valider">
    </form>
</body>

</html>


<?php
    // include("../classes/Stock.php");
    // include("../classes/Boisson.php");
    // include("../classes/Recette.php");

    // $recettesExistantes = array();
    // $bdRecettes=fopen("../bdRecettes.txt", "r");
    
    // while (! (feof($bdRecettes))) {
    //     $ligne = fgets($bdRecettes);
    //     $ligneExplode = explode(",", $ligne);
    //     $uneRecetteBD = new Recette();
    //     $uneRecetteBD->setNomRecette($ligneExplode[0]." ".$ligneExplode[1]);
    //     $uneRecetteBD->setAlcool($ligneExplode[0]);
    //     $uneRecetteBD->setDiluant($ligneExplode[1]);
        
    //     array_push($recettesExistantes, $uneRecetteBD);
    // }

    // $coca=new Boisson("coca",2,10,10);
    // $rhum=new Boisson("rhum",1,5,5);
    
    // $stockSoiree=new Stock ();
    // $stockSoiree->setLDiluants($coca);
    // $stockSoiree->setLAlcools($rhum);

include("classes/Stock.php");
include("classes/Boisson.php");

$nomBoissonSaisie=$_POST['nomBoisson'];
$qtBoissonSaisie=$_POST['qtBoisson'];

$stockSoiree= new Stock();

    if ($nomBoissonSaisie !="" && $qtBoissonSaisie !="") {
        
        $boissonSaisie=new Boisson();
        $bdBoisson=fopen("bdBoisson.txt","r");

        while (!feof($bdBoisson)) {
            
            $ligneBD=fgets($bdBoisson);
            $ligneExplode=explode(",",$ligneBD);

            $nomBoissonBD=$ligneExplode[0];
            $typeBoisson=$ligneExplode[1];

            if ($nomBoissonBD=$nomBoissonSaisie) {
                
                if ($typeBoisson=="alcool") {
                    
                    $boissonSaisie->setNomBoisson($nomBoissonSaisie);
                    $boissonSaisie->setQtBoissonInitiale($qtBoissonSaisie);
                    $boissonSaisie->setQtBoissonEnCours($qtBoissonSaisie);
                    $boissonSaisie->setTypeBoisson(1);

                    $stockSoiree->setLAlcools($boissonSaisie);

                    break;
                }
                if ($typeBoisson=="diluant") {
                    
                    $boissonSaisie->setNomBoisson($nomBoissonSaisie);
                    $boissonSaisie->setQtBoissonInitiale($qtBoissonSaisie);
                    $boissonSaisie->setQtBoissonEnCours($qtBoissonSaisie);
                    $boissonSaisie->setTypeBoisson(2);

                    $stockSoiree->setLAlcools($boissonSaisie);

                    break;
                }
                if ($typeBoisson=="autre") {
                    
                    $boissonSaisie->setNomBoisson($nomBoissonSaisie);
                    $boissonSaisie->setQtBoissonInitiale($qtBoissonSaisie);
                    $boissonSaisie->setQtBoissonEnCours($qtBoissonSaisie);
                    $boissonSaisie->setTypeBoisson(3);

                    $stockSoiree->setLAlcools($boissonSaisie);

                    break;
                }
            fclose($bdBoisson);
            }
        }

        print("votre boisson a bien était prise en compte <br>");
        print("Voici le stock : ".$stockSoiree->toString()."<br>");
    } 
    else {
        print("j'ai rien");
    }
?>