<?php
require_once 'ImageExporter.php';

$polices = glob('../asset/font/*.ttf'); // Choix de la police
$cheminPolice = $polices ? $polices[array_rand($polices)] : '../asset/font/Montserrat-Medium.ttf'; // Choix de la police par default
$texteCitation = isset($_GET['citation']) ? $_GET['citation'] : 'Citation manquante';
$cheminSortie = '../asset/image/citation.png';

ImageExporter::exporterEnImage($texteCitation, $cheminPolice, $cheminSortie, 500); // $imageSize = (X)px (modifiable)

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="citation.png"');
readfile($cheminSortie);
unlink($cheminSortie);
