<?php
class CitationGenerator {
    private $debut;
    private $milieu;
    private $fin;

    public function __construct() {
        $jsonPath = __DIR__ . '/fragments.json';
        $jsonContent = file_get_contents($jsonPath);
        $fragments = json_decode($jsonContent, true);

    
        $this->debut = $fragments['debut'];
        $this->milieu = $fragments['mid'];
        $this->fin = $fragments['fin'];
    }

    public function genererCitation() {
        $partie1 = $this->debut[array_rand($this->debut)];
        $partie2 = $this->milieu[array_rand($this->milieu)];
        $partie3 = $this->fin[array_rand($this->fin)];
        return $partie1 . ' ' . $partie2 . ' ' . $partie3;
    }
}
