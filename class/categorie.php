<?php

class categorie
{

    private $categorie;
    private $sous_categorie;

    public function setCategorie(string $categorie)
    {

        $this->categorie = $categorie;
    }

    public function getCategorie(): string
    {

        return $this->categorie;
    }
    public function setSousCategorie(string $sous_categorie)
    {

        $this->sous_categorie = $sous_categorie;
    }

    public function getSousCategorie(): string
    {

        return $this->sous_categorie;
    }
}
