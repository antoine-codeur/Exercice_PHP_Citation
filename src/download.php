<?php
require_once 'ImageExporter.php';

$polices = glob('../asset/font/*.ttf');
$cheminPolice = $polices ? $polices[array_rand($polices)] : '../asset/font/Montserrat-Medium.ttf';
$texteCitation = isset($_GET['citation']) ? $_GET['citation'] : 'Citation manquante';
$cheminSortie = '../asset/image/citation.png';

ImageExporter::exporterEnImage($texteCitation, $cheminPolice, $cheminSortie, 500); //image de 500px par 500px

header('Content-Type: image/png');
header('Content-Disposition: attachment; filename="citation.png"');
readfile($cheminSortie);
unlink($cheminSortie);
