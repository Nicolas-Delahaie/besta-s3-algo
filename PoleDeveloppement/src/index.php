<html>

<body>
    <form action="./fonctions/saisieVerif.php" method="POST">
        <p>Sélectionnez le nom de la boisson </p>
        <select name="nomBoisson" id="nomBoisson">
            <option value="default">Boisson</option>
            <?php
            //Recuperer fichier json
            $json = file_get_contents('./datas/bdBoissons.json');
            //Decode le json
            $json_data = json_decode($json,true);
            //Parcourss du json
            foreach ($json_data['Boisson'] as $boisson) {
                //Recuperation du nom de la boisson

                $nomBoisson = $boisson["nomBoisson"];
                //Affichage du nom de la boisson
                echo "<option value=".$nomBoisson.">".$nomBoisson."</option>";
            }
            ?>
        </select>
        <p>Sélectionnez la quantité de votre boisson</p>
        <input type="number" name="qtBoisson" value="qtBoisson">
        <br>
        <input type="submit" value="Valider">
    </form>
    <a href="main.php">Les Resultats</a>
</body>

</html>