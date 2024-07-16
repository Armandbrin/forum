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
    <title>Inscription</title>
</head>

<body>
    <header class="flex justify-between items-center lg:pl-32 pl-4 lg:pr-32 pr-4 h-24 border-b-[1px] border-[#ed231a]">
        <a href="index.php"><img class="lg:w-[10vw] w-[26vw] lg:h-[7vh] h-[9vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <nav class="flex gap-5 items-center">
            <form action="index.php">
                <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Accueil</button>
            </form>
            <form action="connexion.php">
                <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Connexion</button>
            </form>
        </nav>
    </header>
    <main class="flex items-center flex-col py-[16.2vh] bg-cover bg-center" style="background-image: url(img/fond.jpg)">
        <h1 class="text-2xl mb-2">Inscription:</h1>
        <form class="flex flex-col gap-5 border-2 border-black p-5 rounded-lg w-[70vw] bg-white" action="connexion.php" method="post">
            <input class="border-2 border-black p-1 rounded-lg bg-gradient-to-l from-red-600 to-red-800 text-white placeholder-white" type="text" name="i-nom" id="" placeholder="Nom">
            <input class="border-2 border-black p-1 rounded-lg bg-gradient-to-l from-red-600 to-red-800 text-white placeholder-white" type="text" name="i-prenom" id="" placeholder="Prénom">
            <input class="border-2 border-black p-1 rounded-lg bg-gradient-to-l from-red-600 to-red-800 text-white placeholder-white" type="email" name="i-email" id="" placeholder="Email">
            <input class="border-2 border-black p-1 rounded-lg bg-gradient-to-l from-red-600 to-red-800 text-white placeholder-white" type="password" name="i-mdp" id="" placeholder="Mot-de-passe">
            <button class="border-2 border-black p-1 bg-gradient-to-l from-red-600 to-red-800 text-white rounded-lg w-full" type="submit" name="inscription">Envoyer</button>
        </form>
    </main>
    <footer class="flex justify-between items-center lg:pl-32 pl-4 lg:pr-32 pr-4 h-12 border-t-[1px] border-[#ed231a] fixed bottom-0 w-full">
        <a href="index.php"><img class="lg:w-[10vw] w-[13vw] lg:h-[7vh] h-[4.5vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>

</body>

</html>