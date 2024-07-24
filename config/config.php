<?php
require_once("class/categorie.php");
require_once("class/users.php");
require_once("class/posts.php");
require_once("class/reponse.php");
require_once("class/report.php");
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
            return $done->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getAllUsersId($id)
    {
        try {
            $sql = $this->bdd->prepare("SELECT * FROM users WHERE users.id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return $sql->fetchAll();
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

    public function getAllPost($sous_categorie_id)
    {
        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("SELECT * FROM posts JOIN sous_categorie ON sous_categorie.id = posts.id_sous_categorie WHERE posts.id_sous_categorie = :sous_categorie");
            $sql->bindParam(":sous_categorie", $sous_categorie_id);
            $sql->execute();
            $this->bdd->commit();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }
    public function getAllPost2($id)
    {
        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("SELECT * FROM posts JOIN sous_categorie ON sous_categorie.id = posts.id_sous_categorie WHERE posts.id = :id");
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
    public function getIdPost($id)
    {
        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("SELECT id FROM posts WHERE id_sous_categorie = :id");
            $sql->bindparam(":id", $id);
            $sql->execute();
            $this->bdd->commit();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function addPost(posts $post): void
    {
        try {
            $this->bdd->beginTransaction();
            $titre = $post->getPostTitre();
            $contenue = $post->getPostContenue();
            $idSousCategorie = $post->getIdSousCategoriePost();
            $idUser = $post->getIdUserPost();

            $sql = $this->bdd->prepare("INSERT INTO posts (titre, contenue, id_sous_categorie, id_user) VALUES (:titre, :contenue, :id_sous_categorie, :id_user)");
            $sql->bindParam(":titre", $titre);
            $sql->bindParam(":contenue", $contenue);
            $sql->bindParam(":id_sous_categorie", $idSousCategorie);
            $sql->bindParam(":id_user", $idUser);
            $sql->execute();
            $this->bdd->commit();
        } catch (PDOException $e) {
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
            return $done->fetchAll();
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
            $sql = $this->bdd->prepare("SELECT * FROM sous_categorie JOIN categorie ON categorie.id = sous_categorie.id_categorie WHERE sous_categorie.id_categorie = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            $this->bdd->commit();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function getSousCategorie($id)
    {
        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("SELECT * FROM sous_categorie WHERE id = :id");
            $sql->bindparam(":id", $id);
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
            throw new Exception("error");
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
            throw new Exception("error");
        }
    }

    public function delSousCategorie($id)
    {

        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("DELETE FROM sous_categorie WHERE id = :id");
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
    public function delPost($id)
    {

        try {
            $this->bdd->beginTransaction();
            $sql = $this->bdd->prepare("DELETE FROM posts WHERE posts.id = :id");
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



    public function getAllReponse($id)
    {
        try {
            $sql = $this->bdd->prepare("SELECT * FROM reponse JOIN posts ON reponse.id_post = posts.id 
            JOIN users ON reponse.id_user = users.id WHERE posts.id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }
    public function getAllReponseId($id)
    {
        try {
            $sql = $this->bdd->prepare("SELECT * FROM reponse WHERE reponse.id = :id");
            $sql->bindParam(":id", $id);
            $sql->execute();
            return $sql->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }
    public function getIdReponse()
    {
        try {
            $sql = $this->bdd->prepare("SELECT id FROM reponse");
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function addReponse(reponse $rep): void
    {
        try {
            $this->bdd->beginTransaction();
            $text = $rep->getText();
            $post = $rep->getIdPost();
            $user = $rep->getIdUser();
            $sql = $this->bdd->prepare("INSERT INTO reponse (contenue, id_post, id_user) VALUES (:contenue, :id_post, :id_user)");
            $sql->bindParam(":contenue", $text);
            $sql->bindParam(":id_post", $post);
            $sql->bindParam(":id_user", $user);
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

    public function getAllReport()
    {
        try {
            $sql = "SELECT * FROM report";
            $done = $this->bdd->query($sql);
            return $done->fetchAll();
        } catch (PDOException $e) {
            $this->bdd->rollBack();
            $error = fopen("error.log", "w");
            $txt = $e . "\n";
            fwrite($error, $txt);
            throw new Exception("error");
        }
    }

    public function addReportPost(report $report): void
    {
        try {
            $this->bdd->beginTransaction();
            $message = $report->getId_message();
            $user = $report->getId_user();
            $post = $report->getId_post();
            $sql = $this->bdd->prepare("INSERT INTO report (id_message, id_user, id_post) VALUES (:id_message, :id_user, :id_post)");
            $sql->bindParam(":id_message", $message);
            $sql->bindParam(":id_user", $user);
            $sql->bindParam(":id_post", $post);
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
    public function addReportReponse(report $report): void
    {
        try {
            $this->bdd->beginTransaction();
            $message = $report->getId_message();
            $user = $report->getId_user();
            $reponse = $report->getId_reponse();
            $sql = $this->bdd->prepare("INSERT INTO report (id_message, id_user, id_reponse) VALUES (:id_message, :id_user, :id_reponse)");
            $sql->bindParam(":id_message", $message);
            $sql->bindParam(":id_user", $user);
            $sql->bindParam(":id_reponse", $reponse);
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

    public function disconnect()
    {
        $this->bdd = null;
    }
}
