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
            $this->bdd->beginTransaction();
            $users = $this->getAllUsers();
            foreach ($users as $user) {
                if ($param["user"] == $user["email"] && password_verify($param['pass'], $user["mdp"])) {
                    return $user;
                }
            }
            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllUsers()
    {
        try {
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
            $this->bdd->beginTransaction();
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
            $this->bdd->commit();
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

    public function getIdCategorie()
    {
        try {
            $sql = "SELECT id FROM categorie";
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

    public function addCategorie(categorie $name): void
    {
        try {
            $this->bdd->beginTransaction();
            $nom_categorie = $name->getNameCategorie();
            $sql = $this->bdd->prepare("INSERT INTO categorie (name) VALUES (:name)");
            $sql->bindParam(":name", $nom_categorie);
            $sql->execute();
            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            // throw new Exception("error");
        }
    }

    public function addSousCategorie(categorie $name): void
    {
        try {
            $this->bdd->beginTransaction();
            $nom_sous_categorie = $name->getNameSousCategorie();
            $id_categorie = $name->getIdCategorieSousCategorie();
            $sql = $this->bdd->prepare("INSERT INTO sous_categorie (nom, id_categorie) VALUES (:nom, :id_categorie)");
            $sql->bindParam(":nom", $nom_sous_categorie);
            $sql->bindParam(":id_categorie", $id_categorie);
            $sql->execute();
            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            // throw new Exception("error");
        }
    }

    public function delSousCategorie(categorie $categorie)
    {

        try {
            $this->bdd->beginTransaction();
            $id = $categorie->getIdSousCategorie();
            $sql = $this->bdd->prepare("DELETE FROM sous_categorie WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            // throw new Exception("error");
        }
    }

    public function delCategorie($id)
    {

        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("DELETE FROM categorie WHERE id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $this->bdd->commit();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }


    public function getAllSousCategorie($id)
    {
        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("SELECT * FROM sous_categorie JOIN categorie ON sous_categorie.id_categorie = categorie.id WHERE categorie.id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $this->bdd->commit();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
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
