<?php
require_once 'src/CitationGenerator.php';

$generator = new CitationGenerator();

$citations = [];
$nombreCitations = 1;

if (isset($_GET['Citation'])) {
    $nombreCitations = !empty($_GET['nombreCitations']) ? intval($_GET['nombreCitations']) : 1;
    
    for ($i = 0; $i < $nombreCitations; $i++) {
        $citations[] = $generator->genererCitation();
    }
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
            <div>
                <label for="nombreCitations">Nombre de citations à générer :</label>
                <input type="number" id="nombreCitations" name="nombreCitations" min="1" value="<?php echo $nombreCitations; ?>">
            </div>
            <button type="submit" name="Citation">Générer des Citations</button>
        </form>

        <?php if (!empty($citations)): ?>
        <div id="citation_result">
            <?php foreach ($citations as $citation): ?>
                <p><?php echo htmlspecialchars($citation); ?></p>
                <a href="src/download.php?citation=<?php echo urlencode($citation); ?>" class="download-link">Télécharger en PNG</a>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
