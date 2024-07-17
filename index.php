<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['c-email']);
    $mdp = htmlspecialchars($_POST['c-mdp']);

    if (!empty($_POST['c-email']) && !empty($_POST['c-mdp'])) {
        $user = $bdd->connexion(["user" => $email, "pass" => $mdp]);
        if ($user) {
            $_SESSION["user"] = $user;
        }
    }
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
        <?php foreach ($bdd->getAllCategorie() as $categorie) { ?>

            <section class="mx-10 mt-2 bg-red-800 rounded-lg">
                <a href="">
                    <h2 class="p-1"><?php print $categorie['name'] ?></h2>
                </a>
                <?php foreach ($bdd->getAllSousCategorie($categorie['id']) as $sous_categorie) { ?>
                    <section class="flex justify-between items-center bg-red-600 p-1 border-b-[1px] border-red-500">
                        <a href="">
                            <h2><?php print $sous_categorie["nom"] ?></h2>
                        </a>
                        <article class="flex gap-2">
                            <img class="w-5 h-5" src="img/message.svg" alt="icone message">
                            <p>0</p>
                        </article>
                    </section>
                <?php } ?>
            </section>
        <?php } ?>

    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] fixed bottom-0 w-full">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>
</body>

</html>