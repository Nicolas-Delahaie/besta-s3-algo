<?php
    $bdd="ocesat";
    $host="lakartxela.iutbayonne.univ-pau.fr";
    $user="ocesat";
    $pass="ocesat";

    $nomTable="bourse";
    
    $link=mysqli_connect($host,$user,$pass,$bdd) or die("Impossible de se connecter à la base de données");

    $query= "SELECT * FROM ".$nomtable;
    $result=mysqli_query($link,$query);

    if (mysqli_connect_errno()) {
        print("Erreur de connexion : ".mysqli_connect_errno());
        exit();
    }
?>