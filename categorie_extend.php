<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

$idCat = $_GET["cat"];
$sousCat = $bdd->getAllSousCategorie($idCat);
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
    <header class="flex justify-between items-center px-32 h-24 border-b-[1px] border-[#ed231a]">
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
    <main class="flex flex-col items-center bg-gray-300 pt-10 h-[75vh] bg-center bg-cover bg-fixed" style="background-image: url(https://static.vecteezy.com/ti/vecteur-libre/p3/265609-illustrationle-paysage-rouge-vectoriel.png)">
        <section class="bg-red-600 h-auto w-[60vw] mb-10 pb-2 rounded-lg border-white border-[1px]" style="box-shadow: 8px 8px 5px white;">
            <article class="mx-2 mt-2 rounded-t-lg p-1">
                <h2><?= $sousCat[0]["name"] ?></h2>
            </article>
            <?php foreach ($bdd->getAllSousCategorie($idCat) as $sous_categorie) { ?>
                <article class="flex justify-between bg-white mb-2 rounded-lg p-1 border-b-[1px] border-red-500 mx-2">
                    <a class="w-full" href="sous_categorie_extend.php?cat=<?= $sous_categorie[0] ?>"><h2><?= $sous_categorie['nom'] ?></h2></a>
                </article>
            <?php } ?>
        </section>
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] bg-white">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>
</body>

</html>