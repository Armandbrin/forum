<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

$idPost = $_GET["post"];


if (isset($_POST["envoyer"])) {
    $contenue = htmlspecialchars(trim($_POST["reponse"]));


    $newReponse = new reponse();
    $newReponse->setText($contenue);
    $newReponse->setIdPost($idPost);
    $newReponse->setIdUser($_SESSION["user"]["id"]);

    $bdd->addReponse($newReponse);
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
        <section class="flex items-center flex-col">
            <?php 
            foreach ($bdd->getAllPost2($idPost) as $posts) { ?>
                <article class="border-2 border-black rounded-lg p-2 w-[60vw]">
                    <h2 class="text-xl underline"><?= $posts["titre"] ?></h2>
                    <p><?= $posts["contenue"] ?></p>
                </article>
            <?php } $idReponse = $bdd->getIdReponse($idPost);
            foreach ($bdd->getAllReponse($idReponse[0]["id"]) as $rep) { 
                ?>
                <article class="border-2 border-black rounded-lg p-2 w-[60vw]">
                    <p><?= $rep[0]["contenue"] ?></p>
                </article>
            <?php } ?>
            <article class="border-2 border-black rounded-lg p-2 w-[60vw]">
                <form class="flex flex-col items-center" method="post">
                    <textarea class="w-[40vw] border-2 border-black rounded-lg p-2" name="reponse" placeholder="Réponse"></textarea>
                    <button type="submit" name="envoyer">Envoyer</button>
                </form>
            </article>
        </section>

    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] mt-10">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>
</body>

</html>