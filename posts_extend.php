<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

$idPost = $_GET["post"];


if (isset($_POST["envoyer"]) && isset($_SESSION["user"])) {
    $contenue = htmlspecialchars(trim($_POST["reponse"]));


    $newReponse = new reponse();
    $newReponse->setText($contenue);
    $newReponse->setIdPost($idPost);
    $newReponse->setIdUser($_SESSION["user"]["id"]);

    $bdd->addReponse($newReponse);

    $mess = NULL;
} else {
    $mess = "Veuillez vous connecter/inscrire pour repondre a un post";
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
    <main style="background-image: url(https://static.vecteezy.com/ti/vecteur-libre/p3/265609-illustrationle-paysage-rouge-vectoriel.png)">
        <section class="flex items-center flex-col">
            <?php
            foreach ($bdd->getAllPost2($idPost) as $posts) { ?>
                <article class="border-2 bg-red-800 text-white border-black rounded-lg p-2 w-[60vw] mb-10">
                    <h2 class="text-xl underline"><?= $posts["titre"] ?></h2>
                    <p><?= $posts["contenue"] ?></p>
                </article>
            <?php }
            foreach ($bdd->getAllReponse($idPost[0]) as $rep) { ?>
                <article class="border-2 border-black bg-red-600 rounded-lg p-2 w-[60vw] mb-10 text-white">
                    <p class="underline">Commentaire ecrit par : <?= $rep[10] ?></p>
                    <p class="text-lg"><?= $rep[1] ?></p>
                </article>
            <?php } ?>
            <article class="border-2 border-black rounded-lg p-2 w-[60vw] bg-red-500">
                <form class="flex flex-col items-center" method="post">
                    <textarea class="w-[40vw] h-24 border-2 border-black rounded-lg p-2 overflow-y-auto resize-none" name="reponse" placeholder="Réponse"></textarea>
                    <button class="p-1 border-2 border-black rounded-lg mt-1 bg-gradient-to-l from-red-600 to-red-800" type="submit" name="envoyer">Envoyer</button>
                    <p class="underline text-md text-white"><?php if (isset($mess)) { print $mess; } ?></p>
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