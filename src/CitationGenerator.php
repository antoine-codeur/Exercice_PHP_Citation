<?php
class CitationGenerator {
    private $debut;
    private $milieu;
    private $fin;
    private $auteurs;

    public function __construct() {
        $jsonPath = __DIR__ . '/json/fragments.json';
        $jsonContent = file_get_contents($jsonPath);
        $fragments = json_decode($jsonContent, true);

        $this->debut = $fragments['debut'];
        $this->milieu = $fragments['mid'];
        $this->fin = $fragments['fin'];
        $this->auteurs = $fragments['auteurs'];
    }

    public function genererCitation() {
        $partie1 = $this->debut[array_rand($this->debut)];
        $partie2 = $this->milieu[array_rand($this->milieu)];
        $partie3 = $this->fin[array_rand($this->fin)];
        $auteur = $this->auteurs[array_rand($this->auteurs)];

    
        return [
            'citation' => '"' . $partie1 . ' ' . $partie2 . ' ' . $partie3 . '"',
            'auteur' => $auteur
        ];
    }
}