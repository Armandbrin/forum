<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();



if (isset($_POST["send"])) {
    $titre = htmlspecialchars(trim($_POST["titre"]));
    $contenue = htmlspecialchars(trim($_POST["contenue"]));

    if (isset($_POST['sous_categorie'])) {
        $sous_categorie = $_POST['sous_categorie'];
    }

    $newPost = new posts();
    $newPost->setPostTitre($titre);
    $newPost->setPostContenue($contenue);
    $newPost->setIdUserPost($_SESSION["user"]["id"]);
    $newPost->setIdSousCategoriePost($sous_categorie);

    $bdd->addPost($newPost);
}



?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Profil</title>
</head>

<body>
    <header class="flex justify-between items-center lg:pl-32 pl-4 lg:pr-32 pr-4 h-24 border-b-[1px] border-[#ed231a]">
        <a href="index.php"><img class="lg:w-[10vw] w-[26vw] lg:h-[7vh] h-[9vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <nav class="flex gap-5 items-center">
            <form action="index.php">
                <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Accueil</button>
            </form>
            <?php if (isset($_SESSION["user"])) {
                if ($_SESSION["user"]["statut"] == "admin") { ?>
                    <form action="admin.php">
                        <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Admin</button>
                    </form>
                <?php } ?>
                <form action="logout.php">
                    <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Déconnexion</button>
                </form>
            <?php } ?>
        </nav>
    </header>
    <main class="flex flex-col items-center bg-cover bg-center" style="background-image: url(img/fond2.jpg); padding-bottom: 43vh; background-size: 100vw 70.5vh;">
        <?php foreach ($bdd->getAllUsers() as $user) {
            if ($_SESSION["user"]["id"] == $user["id"]) { ?>
                <section class="border-2 border-black p-5 flex justify-between gap-5 rounded-lg w-[40vw] bg-white mt-10">
                    <article class="flex flex-col gap-4 border-r-2 border-black pr-24">
                        <h2 class="text-xl underline">Information personnelle:</h2>
                        <p>Nom: <?php print $user["nom"] ?></p>
                        <p>Prénom: <?php print $user["prenom"] ?></p>
                        <p>Email: <?php print $user["email"] ?></p>
                    </article class="flex flex-col gap-2">
                    <article>
                        <h2 class="text-xl underline">Photo de profil:</h2>
                        <img class="w-32 h-32 mt-2" src="img/profil.jpg" alt="ajouter une photo de profil">
                    </article>
                </section>
        <?php }
        } ?>
        <section class="flex items-center flex-col my-8">
            <h1 class="text-2xl mb-2">Création d'une catégorie:</h1>
            <form class="flex flex-col gap-5 border-2 border-black p-5 rounded-lg w-[60vw] bg-white" action="" method="post">
                <input class="border-2 border-black p-1 rounded-lg" type="text" name="titre" id="" placeholder="titre">
                <textarea class="border-2 border-black p-1 rounded-lg" name="contenue" id="" placeholder="contenue"></textarea>
                <label>Sous-catégorie associée:</label>
                <select name="sous_categorie">
                    <?php foreach ($bdd->getAllCategorie() as $c) { ?>
                        <?php foreach ($bdd->getAllSousCategorie($c["id"]) as $sousCategorie) { ?>
                            <option value="<?= $sousCategorie[0] ?>"><?= $sousCategorie["nom"] ?></option>
                    <?php }
                    } ?>
                </select>

                <button class="border-2 border-black p-1 bg-gradient-to-l from-red-600 to-red-800 text-white rounded-lg" type="submit" name="send">Ajouter</button>
            </form>
        </section>
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a]">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>

</body>

</html>