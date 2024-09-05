<html>

<head>
    <link rel="stylesheet" href="src/styles/index.css">
    <link rel="stylesheet" href="src/styles/page_ajout_boissons.css">
</head>

<body>
    <form action="./src/fonctions/fonctionsIndex.php" method="POST">
        <p>Nom de votre boisson </p>
        <select name="nomBoisson" id="nomBoisson">
            <option value="default">Boisson</option>
            <?php
            //Recuperer fichier json
            $json = file_get_contents('src/datas/bdBoissons.json');
            //Decode le json
            $json_data = json_decode($json, true);
            //Parcourss du json
            foreach ($json_data['Boisson'] as $boisson) {
                //Recuperation du nom de la boisson

                $nomBoisson = $boisson["nomBoisson"];
                //Affichage du nom de la boisson
                echo "<option value=" . $nomBoisson . ">" . $nomBoisson . "</option>";
            }
            ?>  
        </select>
        <p>Volume (en litres)</p>
        <input type="number" step="any" name="qtBoisson" value="qtBoisson" id="zoneVolume">
        <br>
        <section>
            <input type="submit" value="Valider" class="btn">
            <a href="src/main.php" class="btn">Résultats</a>
        </section>
    </form>
</body>

</html>