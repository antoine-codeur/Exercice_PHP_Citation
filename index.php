<?php
session_start(); 
if (!isset($_SESSION['theme'])) {
    $_SESSION['theme'] = 'light'; 
}
if (isset($_POST['theme'])) {
    $_SESSION['theme'] = $_POST['theme'];
    exit; 
}
require_once 'src/CitationGenerator.php'; 
$generator = new CitationGenerator();
if (!isset($_SESSION['citations'])) {
    $_SESSION['citations'] = [];
}
if (!isset($_SESSION['nombreCitations'])) {
    $_SESSION['nombreCitations'] = 1; 
}
if (isset($_POST['generate']) && $_POST['generate'] == 1) {
    $nombreCitations = !empty($_POST['nombreCitations']) ? intval($_POST['nombreCitations']) : 1;
    $_SESSION['nombreCitations'] = $nombreCitations;
    
    $_SESSION['citations'] = [];
    for ($i = 0; $i < $nombreCitations; $i++) {
        $_SESSION['citations'][] = $generator->genererCitation();
    }
    // Redirection vers la même page avec une méthode GET pour éviter la resoumission des données lors de l'actualisation
    header('Location: index.php');
    exit;
}
$citations = $_SESSION['citations'];
$nombreCitations = $_SESSION['nombreCitations']; 
?>
<!DOCTYPE html>
<html lang="fr" data-theme="<?php echo $_SESSION['theme']; ?>">
<head>
    <meta charset="UTF-8">
    <title>Générateur de Citations</title>
    <link rel="stylesheet" href="asset/style/style.css">
</head>
<body>
<button id="themeDarkToggle" onclick="changeTheme()">Changer de thème</button>
    <div class="container">
        <h1>Générateur de Citations</h1>
        <form action="index.php" method="post">
            <div>
                <label for="nombreCitations">Nombre de citations à générer :</label>
                <input type="number" id="nombreCitations" name="nombreCitations" min="1" value="<?php echo $nombreCitations; ?>">
            </div>
            <input type="hidden" name="generate" value="1">
            <button id="Gen_Button" type="submit" name="Citation">Générer des Citations</button>
        </form>

        <?php include 'asset/template/Citation.php'; ?>

    </div>
    <script src="asset/script/themeDark.js"></script>
</body>
</html>