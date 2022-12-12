<!DOCTYPE html>
<html>

<body>
    <form action="resultat.php" method="post">
        <select name="liste" id="liste">
            <option value="default">selectionnez un utilisateur</option>
            <?php
            // $bdd="db_besta";
            // $host="192.168.1.12";
            // $user="admin";
            // $pass="12345";
    
            $bdd = "sae_reseau";
            $host = "localhost";
            $user = "root";
            $pass = "";
    
            $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");
    
            $query = "SELECT nom FROM UTILISATEUR";
            $result = mysqli_query($link, $query);
    
            if (mysqli_connect_errno()) {
                $erreur = "Erreur de connexion :" . mysqli_connect_errno();
                exit();
            } else {
                while ($utilisateur = mysqli_fetch_assoc($result)) {
                    echo  "<option value='".$utilisateur['nom']."'>".$utilisateur['nom']."</option>";
                    $erreur = "";
                }
            }
            ?>
        </select>
        <input type="submit" value="Voir les resultats">
    </form>

    <?php echo $erreur;?>
</body>

</html>