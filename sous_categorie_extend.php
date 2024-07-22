<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

$idCat = $_GET["cat"];
$sousCat = $bdd->getSousCategorie($idCat);

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
    <header class="flex justify-between items-center px-32 h-24 border-b-[1px] border-[#ed231a] mb-24">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
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
                <form action="profil.php">
                    <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Profil</button>
                </form>
                <form action="logout.php">
                    <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Déconnexion</button>
                </form>
            <?php } else { ?>
                <form action="connexion.php">
                    <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Connexion</button>
                </form>
            <?php } ?>
        </nav>
    </header>
    <main>
        <?php $sous_categorie = $bdd->getSousCategorie($idCat); ?>
        <section class="flex items-center flex-col">
            <article class="flex justify-center bg-red-600 p-1 border-b-[1px] border-red-500 mx-10 text-2xl w-40 rounded-lg mb-10">
                <h2><?= $sous_categorie[0]['nom'] ?></h2>
            </article>
            <?php 
            foreach ($bdd->getAllPost($sous_categorie[0]['id']) as $posts) { 
                ?>
                <article class="border-2 border-black rounded-lg p-2 w-[60vw]">
                    <h2 class="text-xl underline"><a href="posts_extend.php?cat=<?= $sous_categorie[0]['id'] ?>&post=<?= $posts[0] ?>"><?= $posts["titre"] ?></a></h2>
                    <p><a href="posts_extend.php?cat=<?= $sous_categorie[0]['id'] ?>&post=<?= $posts[0] ?>"><?= $posts["contenue"] ?></a></p>
                </article>
            <?php } ?>
        </section>
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] fixed bottom-0 w-full">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>
</body>

</html>