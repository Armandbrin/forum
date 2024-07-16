<?php
require_once("class/categorie.php");
require_once("class/users.php");
class bdd
{
    private $bdd;
    public function connect()
    {
        try {
            $this->bdd = new PDO("mysql:host=localhost;dbname=forum", 'root', 'root');
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function connexion($param = [])
    {
        try {
            $users = $this->getAllUsers();
            foreach ($users as $user) {
                if ($param["user"] == $user["email"] && password_verify($param['pass'], $user["mdp"])) {
                    return $user;
                }
            }
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllUsers()
    {
        try {
            $this->bdd->beginTransaction();
            $sql = "SELECT * FROM users";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function addUser(users $user): void
    {
        try {
            $nom = $user->getNom();
            $prenom = $user->getPrenom();
            $email = $user->getEmail();
            $mdp = $user->getMdp();
            $statut = $user->getStatut();

            $sql = $this->bdd->prepare("INSERT INTO users (nom, prenom, email, mdp, statut) VALUES (:nom, :prenom, :email, :mdp, :statut)");
            $sql->bindParam(":nom", $nom);
            $sql->bindParam(":prenom", $prenom);
            $sql->bindParam(":email", $email);
            $sql->bindParam(":mdp", $mdp);
            $sql->bindParam(":statut", $statut);
            $sql->execute();
        } catch (PDOException $e) {
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllPost()
    {
        try {
            $this->bdd->beginTransaction();
            $sql = "SELECT * FROM posts";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllCategorie()
    {
        try {
            $this->bdd->beginTransaction();
            $sql = "SELECT * FROM categorie";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllSousCategorie()
    {
        try {
            $this->bdd->beginTransaction();
            $sql = "SELECT * FROM sous_categorie";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllReponse()
    {
        try {
            $this->bdd->beginTransaction();
            $sql = "SELECT * FROM reponse";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllReport()
    {
        try {
            $this->bdd->beginTransaction();
            $sql = "SELECT * FROM report";
            $done = $this->bdd->query($sql);
            return $done->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function disconnect()
    {
        $this->bdd = null;
    }
}
