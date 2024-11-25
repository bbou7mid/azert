<?php
namespace Model;

class Hotel {
    private $id;
    private $nom;
    private $ville;
    private $etoile;
    private $prix_nuit;
    private $description;

    public function __construct($id, $nom, $ville, $etoile, $prix_nuit, $description) {
        $this->id = $id;
        $this->nom = $nom;
        $this->ville = $ville;
        $this->etoile = $etoile;
        $this->prix_nuit = $prix_nuit;
        $this->description = $description;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getVille() {
        return $this->ville;
    }

    public function getEtoile() {
        return $this->etoile;
    }

    public function getPrixNuit() {
        return $this->prix_nuit;
    }

    public function getDescription() {
        return $this->description;
    }
}
