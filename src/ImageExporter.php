<?php
class ImageExporter {
    public static function exporterEnImage($texte, $cheminPolice, $cheminSortie, $imageSize = 500) {
        $image = imagecreatetruecolor($imageSize, $imageSize);
        if (rand(0, 4) > 0) { // Paramétrage random
            // Paramétrage fond en dégradé
            $couleurDebut = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            $couleurFin = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            for ($y = 0; $y <= $imageSize; $y++) {
                $r = ($couleurFin >> 16 & 0xFF) * $y / $imageSize + ($couleurDebut >> 16 & 0xFF) * (1 - $y / $imageSize);
                $g = ($couleurFin >> 8 & 0xFF) * $y / $imageSize + ($couleurDebut >> 8 & 0xFF) * (1 - $y / $imageSize);
                $b = ($couleurFin & 0xFF) * $y / $imageSize + ($couleurDebut & 0xFF) * (1 - $y / $imageSize);
                $couleurLigne = imagecolorallocate($image, $r, $g, $b);
                imageline($image, 0, $y, $imageSize, $y, $couleurLigne);
            }
        } else { // Paramétrage fond uni
            $couleurFond = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagefill($image, 0, 0, $couleurFond);
        }
        do { // Paramétrage text selon le fond pour assurer une lisibilité
            $couleurTexte = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            $luminositeTexte = (($couleurTexte >> 16 & 0xFF) + ($couleurTexte >> 8 & 0xFF) + ($couleurTexte & 0xFF)) / 3;
            $luminositeFond = isset($r) ? (($r + $g + $b) / 3) : (($couleurFond >> 16 & 0xFF) + ($couleurFond >> 8 & 0xFF) + ($couleurFond & 0xFF)) / 3;
        } while (abs($luminositeFond - $luminositeTexte) < 100);

        // Paramétrage de mise à la ligne du texte et du choix de la police
        $taillePolice = 20;
        $marge = 10;
        $ligneHauteur = $taillePolice * 1.5;
        $mots = explode(' ', $texte);
        $lignes = [];
        $ligne = '';
        foreach ($mots as $mot) {
            $testLigne = $ligne . ($ligne ? ' ' : '') . $mot;
            $bbox = imagettfbbox($taillePolice, 0, $cheminPolice, $testLigne);
            if ($bbox[2] - $bbox[0] > $imageSize - 2 * $marge) {
                if (!empty($ligne)) {
                    $lignes[] = $ligne;
                    $ligne = $mot;
                }
            } else {
                $ligne = $testLigne;
            }
        }
        if (!empty($ligne)) $lignes[] = $ligne;

        $totalHauteur = count($lignes) * $ligneHauteur;
        $y = ($imageSize - $totalHauteur) / 2 + $taillePolice;
        foreach ($lignes as $ligne) {
            $bbox = imagettfbbox($taillePolice, 0, $cheminPolice, $ligne);
            $ligneLargeur = $bbox[2] - $bbox[0];
            $x = ($imageSize - $ligneLargeur) / 2;
            imagettftext($image, $taillePolice, 0, $x, $y, $couleurTexte, $cheminPolice, $ligne);
            $y += $ligneHauteur;
        }

        imagepng($image, $cheminSortie);
        imagedestroy($image);
    }
}
