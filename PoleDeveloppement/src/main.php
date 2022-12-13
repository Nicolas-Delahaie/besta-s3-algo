
<?php
if ($_POST['qtBoisson']!="") {

    if ($_POST['nomBoisson'] == 'default') {
        header("Location: 1dex.php");
    }
} 

else {
    header("Location: 1dex.php");
}
var_dump($_POST);

?> 