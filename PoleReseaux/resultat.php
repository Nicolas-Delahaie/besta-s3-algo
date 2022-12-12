<!DOCTYPE html>
<html>

<body>
    <p>voici la playlist de l'utilisateur :</p>
    <?php

    $bdd = "sae_reseau";
    $host = "localhost";
    $user = "root";
    $pass = "";

    $link = mysqli_connect($host, $user, $pass, $bdd) or die("Impossible de se connecter à la base de données");

    if (isset($_POST['liste'])) {
        $nomUtilisateur = $_POST['liste'];

        $query = "SELECT musique FROM playlist JOIN utilisateur ON playlist.idUtilisateur=utilisateur.idUtilisateur WHERE utilisateur.nom ='".$nomUtilisateur."'";
        $result = mysqli_query($link, $query);

        if (mysqli_connect_errno()) {
            $erreur = "Erreur de connexion :" . mysqli_connect_errno();
            exit();
        } else {
            while ($musique = mysqli_fetch_assoc($result)) {
                echo $musique['musique'];
                $erreur = "";
            }
        }
    }

    echo $erreur;
    ?>
</body>

</html>