<?php

class ImageExporter {
    public static function exporterEnImage($texte, $cheminPolice, $cheminSortie) {
        $taille = 400; // Taille pour faire l'image carrée
        $image = imagecreatetruecolor($taille, $taille);

        // Décide aléatoirement si le fond est un dégradé
        $degrade = rand(0, 1) == 1;

        if ($degrade) {
            // Créez un dégradé de deux couleurs
            $couleurDebut = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            $couleurFin = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            for ($y = 0; $y <= $taille; $y++) {
                $r = ($y * ($couleurFin >> 16) + ($taille - $y) * ($couleurDebut >> 16)) / $taille;
                $g = ($y * ($couleurFin >> 8 & 255) + ($taille - $y) * ($couleurDebut >> 8 & 255)) / $taille;
                $b = ($y * ($couleurFin & 255) + ($taille - $y) * ($couleurDebut & 255)) / $taille;
                $couleurLigne = imagecolorallocate($image, $r, $g, $b);
                imageline($image, 0, $y, $taille, $y, $couleurLigne);
            }
        } else {
            // Utilisez une couleur de fond unie
            $couleurFond = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
            imagefilledrectangle($image, 0, 0, $taille - 1, $taille - 1, $couleurFond);
        }

        // Générez une couleur de texte qui contraste suffisamment avec le fond
        do {
            $couleurTexte = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        } while ($degrade && $couleurTexte == $couleurFond); // Dans le cas d'un dégradé, cette vérification est plus symbolique

        // Ajoutez le texte
        imagettftext($image, 20, 0, 10, $taille / 2, $couleurTexte, $cheminPolice, $texte);

        // Sauvegardez l'image
        imagepng($image, $cheminSortie);

        // Libérez la mémoire
        imagedestroy($image);
    }
}
