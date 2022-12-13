<html>

<body>
    <form action="main.php" method="POST">
        <p>Sélectionnez le nom de la recette </p>
        <select name="nomBoisson">
            <option value="default">Boisson</option>
            <?php
            $bdBoisson = fopen("bdBoisson.txt", "r");
            while (!(feof($bdBoisson))) {
                $ligne = fgets($bdBoisson);
                $ligneExplode = explode(",", $ligne);
                $nomBoisson = $ligneExplode[0];
                echo "<option value=''>".$nomBoisson."</option>";
            }
            fclose($bdBoisson);
            ?>
        </select>
        <p>Sélectionnez la quantité de votre boisson</p>
        <input type="number" name="qtBoisson" value="qtBoisson">
        <br>
        <input type="submit" value="Valider">
    </form>
</body>

</html>


<?php
    include("../classes/Stock.php");
    include("../classes/Boisson.php");
    include("../classes/Recette.php");

    $recettesExistantes = array();
    $bdRecettes=fopen("../bdRecettes.txt", "r");
    
    while (! (feof($bdRecettes))) {
        $ligne = fgets($bdRecettes);
        $ligneExplode = explode(",", $ligne);
        $uneRecetteBD = new Recette();
        $uneRecetteBD->setNomRecette($ligneExplode[0]." ".$ligneExplode[1]);
        $uneRecetteBD->setAlcool($ligneExplode[0]);
        $uneRecetteBD->setDiluant($ligneExplode[1]);
        
        array_push($recettesExistantes, $uneRecetteBD);
    }

    $coca=new Boisson("coca",2,10,10);
    $rhum=new Boisson("rhum",1,5,5);
    
    $stockSoiree=new Stock ();
    $stockSoiree->setLDiluants($coca);
    $stockSoiree->setLAlcools($rhum);

?> 