<?php

class users{

    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $statut;

    public function setNom(string $nom){
        $this->nom = $nom;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function setPrenom(string $prenom){
        $this->prenom = $prenom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function setMdp(string $mdp){
        $this->mdp = $mdp;
    }

    public function getMdp(): string {
        return $this->mdp;
    }

    public function setStatut(string $statut){
        $this->statut = $statut;
    }

    public function getStatut(): string {
        return $this->statut;
    }






}