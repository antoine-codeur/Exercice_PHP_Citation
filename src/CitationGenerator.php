<?php
class CitationGenerator {
    private $debut = ['La vie est', 'Le monde est', 'L\'aventure est'];
    private $milieu = ['une quête', 'un voyage', 'une cascade de choix'];
    private $fin = ['sans fin.', 'plein de surprises.', 'que nous forgeons.'];

    public function genererCitation() {
        $partie1 = $this->debut[array_rand($this->debut)];
        $partie2 = $this->milieu[array_rand($this->milieu)];
        $partie3 = $this->fin[array_rand($this->fin)];
        return $partie1 . ' ' . $partie2 . ' ' . $partie3;
    }
}
