
<?php
/**
 * Summary of saisiVerif
 * @brief vérifie que les variables transmise sont exploitable
 * @return array liste sous la forme [nomBoisson,qtBoisson]
 */
function saisiVerif()
{
    $resultat=array();
    if ($_POST['qtBoisson'] != "") {
        if ($_POST['nomBoisson'] == 'default') {
            header("Location: 1dex.php");
        }

        $nomBoisson = $_POST['nomBoisson'];
        $qtBoisson = $_POST['qtBoisson'];

        array_push($resultat,$nomBoisson,$qtBoisson);

        header("Location: 1dex.php");

    } 
    else {
        header("Location: 1dex.php");
    }
    return $resultat;
}

?> 