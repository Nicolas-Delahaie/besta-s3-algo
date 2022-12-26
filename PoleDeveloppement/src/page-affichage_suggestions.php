<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Suggestion d'une combinaison de cocktails</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles/style-Affichage_suggestions.css">
    </head>
    <body>
        <section id="containerPrincipal">
            <header>
                <h1>Cocktails optimaux</h1>
            </header>
            <main>
                <?php
                    /**
                     * @brief Affiche la combinaison de cocktails avec les restes
                     * @param list<Cocktail> Cocktails triés par volume total décroissant
                     * @param list<Boisson> Restes de boissons triés par volulmme decroisant 
                     */

                    include ("classes/Recette.php");
                    include ("classes/Boisson.php");
                    $html = "";

                    /** @warning  Les recettes doivent fournis en parametre*/
                    $b1 = new Boisson("captain_morgan", "Alcool", 10, 10);
                    $b2 = new Boisson("ricard", "Alcool", 10, 10);
                    $b3 = new Boisson("Coca", "Diluant", 10, 10);

                    $r1 = new Recette("Captain Coca", $b1, $b3, "999", "1", "3", "0");
                    $r2 = new Recette("Mazout", $b2, $b3, "999", "1", "2", "0");
                    
                    $meilleureCombinaison = array($r1, $r2);
                    $restes = array(new Boisson("jäger", "Alcool", 10, 0.25), new Boisson("absolute_vodka", "Alcool", 10, 0.3), new Boisson("captain_morgan", "Alcool", 10, 0.1));

                    $nbVerresTotaux = 0;
                    $nbShotsTotaux = 0;

                    // ------- Cocktails -------
                    for ($i=0; $i < count($meilleureCombinaison); $i++) {
                        $cocktail = $meilleureCombinaison[$i];
                        $html .= '<article>';
                        $html .= '<img src="datas/img/bouteilles/'.$cocktail->getAlcool()->getNomBoisson().'.jpg" class="imagesBoissons">';
                        $html .= '<img src="datas/img/bouteilles/'.$cocktail->getDiluant()->getNomBoisson().'.jpg" class="imagesBoissons">';
                        $html .= '<p class="separateur">=</p>';
                        $html .= '<section class="zoneVerres">';
                        #Calcul du nombre de verres de 20cl
                        $nbVerres = floor(($cocktail->getQtAlcool()+$cocktail->getQtDiluant())/0.2);
                        $nbVerresTotaux += $nbVerres;
                        for ($n=0; $n < $nbVerres; $n++) 
                        { 
                            $html .= '<img src="datas/img/verre.jpg" class="verres">';
                        }
                        $html .= '</section></article>';
                    }

                    // ------- Restes -------
                    $html .= '<h2>Boissons restantes</h2>';
                    for ($i=0; $i < count($restes); $i++) {
                        $reste = $restes[$i];
                        $html .= '<article>';
                        $html .= '<img src="datas/img/bouteilles/'.$reste->getNomBoisson().'.jpg" class="imagesBoissons imagesRestes">';
                        $html .= '<p class="separateur">=</p>';
                        $html .= '<section class="zoneShots">';
                        #Calcul du nombre de shots de 4cl
                        $nbShots = floor($reste->getQtBoissonEnCours() / 0.04);
                        $nbShotsTotaux += $nbShots;
                        for ($n=0; $n < $nbShots; $n++) 
                        {
                            $html .= '<img src="datas/img/shot.jpg" class="shots">';
                        }
                        $html .= '</section></article>';
                    }

                    // ------- Total -------
                    $html .= '<h2>Au total</h2>';
                    $html .= '<article><p class="sommesFinales">'.strval($nbVerresTotaux).'</p><p class="separateur">X</p><img src="datas/img/verre.jpg" id="verresTotaux"></article>';
                    $html .= '<article><p class="sommesFinales">'.strval($nbShotsTotaux).'</p><p class="separateur">X</p><img src="datas/img/shot.jpg" id="shotsTotaux"></article>';


                    echo $html;
                ?>

                
                    
                <!-- </article>
                <article>
                    <p class="sommesFinales">20</p>
                    <p class="separateur">X</p>
                    <img src="shot.jpg" id="shotsTotaux">
                </article> -->
            </main>
        </section>
    </body>
</html>