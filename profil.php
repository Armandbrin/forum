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
    <title>Profil</title>
</head>

<body>
    <header class="flex justify-between items-center lg:pl-32 pl-4 lg:pr-32 pr-4 h-24 border-b-[1px] border-[#ed231a]">
        <a href="index.php"><img class="lg:w-[10vw] w-[26vw] lg:h-[7vh] h-[9vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <nav class="flex gap-5 items-center">
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
    <main class="flex justify-center bg-cover bg-center" style="background-image: url(img/fond2.jpg); padding-bottom: 43vh; background-size: 100vw 70.5vh;">
        <?php foreach ($bdd->getAllUsers() as $user) {
            if ($_SESSION["user"]["id"] == $user["id"]) {
        ?>
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
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] fixed bottom-0 w-full">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>

</body>

</html>