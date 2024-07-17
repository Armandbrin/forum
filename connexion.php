<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

if (isset($_POST['inscription'])) {

    $nom = htmlspecialchars($_POST['i-nom']);
    $prenom = htmlspecialchars($_POST['i-prenom']);
    $email = htmlspecialchars($_POST['i-email']);
    $mdp = htmlspecialchars($_POST['i-mdp']);

    $newUser = new users();
    $newUser->setNom($nom);
    $newUser->setPrenom($prenom);
    $newUser->setEmail($email);
    $newUser->setMdp(password_hash($mdp, PASSWORD_ARGON2ID));
    $newUser->setStatut("user");

    $bdd->addUser($newUser);
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Connexion</title>
</head>

<body>
    <header class="flex justify-between items-center lg:pl-32 pl-4 lg:pr-32 pr-4 h-24 border-b-[1px] border-[#ed231a]">
        <a href="index.php"><img class="lg:w-[10vw] w-[26vw] lg:h-[7vh] h-[9vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <nav class="flex gap-5 items-center">
            <form action="index.php">
                <button type="submit" class="bg-gradient-to-l from-red-600 to-red-800 border-[1px] border-black px-2 py-1 rounded-lg text-white text-xl">Accueil</button>
            </form>
        </nav>
    </header>
    <main class="flex items-center flex-col pt-[10vh] bg-cover bg-center" style="background-image: url(img/fond1.jpg); padding-bottom: 27.2vh; background-size: 75vw 100vh;">
        <form class="flex flex-col items-center gap-5 border-2 border-black p-5 rounded-lg w-[30vw] bg-white" action="index.php" method="post">
            <h1 class="text-2xl mb-2">Connexion:</h1>
            <input class="border-2 border-black p-1 rounded-lg bg-gradient-to-l from-red-600 to-red-800 text-white placeholder-white w-full" type="email" name="c-email" id="" placeholder="Email">
            <input class="border-2 border-black p-1 rounded-lg bg-gradient-to-l from-red-600 to-red-800 text-white placeholder-white w-full" type="password" name="c-mdp" id="" placeholder="Mot-de-passe">
            <button class="border-2 border-black p-1 bg-gradient-to-l from-red-600 to-red-800 text-white rounded-lg w-full" type="submit" name="connexion">Envoyer</button>
            <a class="underline" href="inscription.php">Je n'ai pas de compte</a>
        </form>
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a] fixed bottom-0 w-full">
        <a href="index.php"><img class="w-[10vw] h-[7vh]" src="img/logo-forum.png" alt="logo forum"></a>
        <a href="contact.php">contact</a>
    </footer>

</body>

</html>