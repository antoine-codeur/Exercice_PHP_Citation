<?php

require_once 'src/CitationGenerator.php';

$generator = new CitationGenerator();

if (isset($_POST['exporter']) && !empty($_POST['citation'])) {
    require_once 'src/ImageExporter.php';

    $citation = $_POST['citation'];
    $dossierPolice = 'asset/font/';
    $fichiersPolice = glob($dossierPolice . '*.ttf');

    if($fichiersPolice) {
        $cheminPolice = $fichiersPolice[array_rand($fichiersPolice)];
    } else {
        $cheminPolice = 'chemin/vers/une/police/par/defaut.ttf';
    }

    $cheminSortie = 'asset/image/citation.png';

    ImageExporter::exporterEnImage($citation, $cheminPolice, $cheminSortie);

    // Redirigez l'utilisateur vers l'image ou affichez un lien pour la télécharger
    echo '<a href="' . $cheminSortie . '" download>Télécharger l\'image</a>';
}



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Générateur de Citations</title>
    <link rel="stylesheet" href="asset/css/style.css">
</head>
<body>
    <div class="container">
        <h1>Générateur de Citations</h1>
        <form action="index.php" method="get">
            <button type="submit" name="Citation">Générer une Citation</button>
        </form>

        <?php
        if (isset($_GET['Citation'])) {
            echo '<p>"' . $generator->genererCitation() . '"</p>';
        }
        ?>

        <form action="index.php" method="post">
            <input type="hidden" name="citation" value="<?php echo htmlspecialchars($generator->genererCitation()); ?>">
            <button type="submit" name="exporter">Exporter en Image</button>
        </form>

    </div>
</body>
</html>
