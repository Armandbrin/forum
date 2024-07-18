<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();


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
        <?php foreach ($bdd->getAllCategorie() as $categorie) { ?>
            <section class="mx-10 mt-2 bg-red-800 rounded-t-lg p-1">
                <h2><a href="categorie_extend.php?cat=<?= $categorie["id"] ?>"><?= $categorie['name'] ?></a></h2>
            </section>
            <?php foreach ($bdd->getAllSousCategorie($categorie['id']) as $sous_categorie) {?>
                <section class="flex justify-between bg-red-600 p-1 border-b-[1px] border-red-500 mx-10">
                    <h2><a href="sous_categorie_extend.php?cat=<?= $sous_categorie[0] ?>"><?= $sous_categorie["nom"] ?></a></h2>
                    <article class="flex gap-2 items-center">
                        <a href=""><img class="w-5 h-5" src="img/message.svg" alt="icone message"></a>
                        <p>0</p>
                    </article>
                </section>
            <?php } ?>
        <?php } ?>

    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] mt-10">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>
</body>
</html>