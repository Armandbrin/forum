<?php

class categorie
{


    private $name_categorie;
    private $name_sous_categorie;
    private $id_categorie_sous_categorie;
    private $id_sous_categorie;
    private $id_categorie;

    // table categorie colone name
    public function setNameCategorie(string $name_categorie)
    {

        $this->name_categorie = $name_categorie;
    }

    public function getNameCategorie(): string
    {

        return $this->name_categorie;
    }
    // table sous_categorie colone name
    public function setNameSousCategorie(string $name_sous_categorie)
    {

        $this->name_sous_categorie = $name_sous_categorie;
    }

    public function getNameSousCategorie(): string
    {

        return $this->name_sous_categorie;
    }
    // table sous_categorie colone id-categorie
    public function setIdCategorieSousCategorie(int $id_categorie_sous_categorie)
    {

        $this->id_categorie_sous_categorie = $id_categorie_sous_categorie;
    }

    public function getIdCategorieSousCategorie(): int
    {

        return $this->id_categorie_sous_categorie;
    }
    // table sous_categorie colone id
    public function setIdSousCategorie(int $id_sous_categorie)
    {

        $this->id_sous_categorie = $id_sous_categorie;
    }

    public function getIdSousCategorie(): int
    {

        return $this->id_sous_categorie;
    }
    // table sous_categorie colone id
    public function setIdCategorie(int $id_categorie)
    {

        $this->id_categorie = $id_categorie;
    }

    public function getIdCategorie(): int
    {

        return $this->id_categorie;
    }
}
