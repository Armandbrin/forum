<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

if (isset($_POST["ajouter"]) && !empty($_POST["categorie"])) {
    $categorie = htmlspecialchars($_POST["categorie"]);

    $newCategorie = new categorie();
    $newCategorie->setNameCategorie($categorie);

    $bdd->addCategorie($newCategorie);
}

if (isset($_POST["ajouter"]) && !empty($_POST["sous_categorie"])) {
    $sous_categorie = htmlspecialchars($_POST["sous_categorie"]);
    $sous_categorie_id = htmlspecialchars($_POST["sous_categorie2"]);
    $newCategorie = new categorie();
    $newCategorie->setNameSousCategorie($sous_categorie);
    $newCategorie->setIdCategorieSousCategorie($sous_categorie_id);
    $bdd->addSousCategorie($newCategorie);
}

if (isset($_POST["supp"])) {
    $id = $_POST['supp'];
    $bdd->delCategorie($id);
}

if (isset($_POST["supp2"])) {
    $id = $_POST['supp2'];

    $suppSousCategorie = new categorie();
    $suppSousCategorie->setIdSousCategorie($id);
    $bdd->delSousCategorie($suppSousCategorie);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Accueil</title>
</head>

<body>
    <header class="flex justify-between items-center lg:pl-32 px-4 lg:pr-32 h-24 border-b-[1px] border-[#ed231a]">
        <a href="index.php"><img class="lg:w-[10vw] w-[26vw] lg:h-[7vh] h-[9vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <nav class="flex gap-5 items-center">
            <?php if (isset($_SESSION["user"])) { ?>
                <form action="profil.php">
                    <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Profil</button>
                </form>
                <form action="logout.php">
                    <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Déconnexion</button>
                </form>
            <?php } ?>
        </nav>
    </header>
    <main>
        <section class="flex items-center flex-col my-8">
            <h1 class="text-2xl mb-2">Création d'une catégorie:</h1>
            <form class="flex flex-col gap-5 border-2 border-black p-5 rounded-lg w-[60vw]" action="" method="post">
                <input class="border-2 border-black p-1 rounded-lg" type="text" name="categorie" id="" placeholder="Catégorie">
                <label>Catégorie associée:</label>
                <select name="sous_categorie2">
                    <?php foreach ($bdd->getAllCategorie() as $categorie) { ?>
                        <option value="<?php print $categorie["id"] ?>"><?php print $categorie["name"] ?></option>
                    <?php } ?>
                </select>
                <input class="border-2 border-black p-1 rounded-lg" type="text" name="sous_categorie" id="" placeholder="Sous-catégorie">
                <button class="border-2 border-black p-1 bg-gradient-to-l from-red-600 to-red-800 text-white rounded-lg" type="submit" name="ajouter">Ajouter</button>
            </form>
        </section>
        <?php foreach ($bdd->getAllCategorie() as $categorie) { ?>

            <section class="mx-10 mt-2 bg-red-800 rounded-lg">
                <article class="flex justify-between">
                    <h2 class="p-1"><a href=""><?php print $categorie['name'] ?></a></h2>
                    <form class="border-2 border-black rounded-lg m-1 mr-24 p-1 bg-white" action="" method="post">
                        <button type="submit" name="supp" value="<?= $categorie['id']; ?>">Supprimer</button>
                    </form>
                </article>
                <?php foreach ($bdd->getAllSousCategorie($categorie['id']) as $sous_categorie) { ?>
                    <section class="flex justify-between bg-red-600 p-1 border-b-[1px] border-red-500">
                        <h2><a href=""><?php print $sous_categorie["nom"] ?></a></h2>
                        <article class="flex gap-2 items-center">
                            <form class="border-2 border-black rounded-lg m-1 mr-12 p-1 bg-white" action="" method="post">
                                <button type="submit" name="supp2" value="<?= $sous_categorie['id']; ?>">Supprimer</button>
                            </form>
                            <a href=""><img class="w-5 h-5" src="img/message.svg" alt="icone message"></a>
                            <p>0</p>
                        </article>
                    </section>
                <?php } ?>
            </section>
        <?php } ?>
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] mt-8">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>
</body>

</html>