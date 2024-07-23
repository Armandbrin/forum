<?php
session_start();
require_once("config/config.php");
$bdd = new bdd();
$bdd->connect();

if (isset($_POST["ajouter"]) && !empty($_POST["categorie"])) {
    $categorie = htmlspecialchars($_POST["categorie"]);

    $newCategorie = new categorie();
    $newCategorie->setNameCategorie($categorie);

    $bdd->addCategorie($newCategorie);
}

if (isset($_POST["ajouter"]) && !empty($_POST["sous_categorie"])) {
    $sous_categorie = htmlspecialchars($_POST["sous_categorie"]);
    $sous_categorie_id = htmlspecialchars($_POST["sous_categorie2"]);
    $newCategorie = new categorie();
    $newCategorie->setNameSousCategorie($sous_categorie);
    $newCategorie->setIdCategorieSousCategorie($sous_categorie_id);
    $bdd->addSousCategorie($newCategorie);
}

if (isset($_POST["supp"])) {
    $id = $_POST['supp'];
    $bdd->delCategorie($id);
}

if (isset($_POST["supp2"])) {
    $id = $_POST['supp2'];
    $bdd->delSousCategorie($id);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>Accueil</title>
</head>

<body>
    <header class="flex justify-between items-center px-32 h-24 border-b-[1px] border-[#ed231a]">
        <a href="index.php"><svg width="50px" height="50px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" fill-rule="evenodd">
                    <circle cx="16" cy="16" r="16" fill="#7e1d50" />
                    <path fill="#FFF" d="M16.053 5c.53.319 1.056.645 1.59.956 2.535 1.47 5.07 2.938 7.608 4.402.167.096.241.203.241.408-.005 3.492-.004 6.984.008 10.476 0 .228-.104.323-.27.419-3.017 1.746-6.032 3.495-9.047 5.244-.046.027-.087.063-.13.095h-.11c-.91-.536-1.82-1.077-2.733-1.608-2.154-1.251-4.31-2.5-6.468-3.743-.183-.105-.243-.225-.242-.435.01-3.464.012-6.928.005-10.393 0-.248.085-.373.289-.49 2.989-1.724 5.973-3.454 8.958-5.184.069-.04.128-.098.191-.147h.11zm2.806 17.48c.413.283.817.58 1.233.88.023-.01.057-.024.088-.041 1.35-.781 2.703-1.56 4.049-2.35.08-.047.15-.185.15-.28.007-3.126.006-6.251-.003-9.376a.377.377 0 00-.156-.275c-1.33-.782-2.667-1.55-3.998-2.329-.138-.08-.215-.056-.332.035-.323.253-3.499 2.193-4.743 2.94-.972.582-1.922 1.196-2.674 2.07-1.037 1.205-1.134 2.875-.227 4.185.449.65 1.048 1.144 1.69 1.583.512.349 1.04.673 1.56 1.008-.014.02-.022.04-.036.048-.686.398-1.37.8-2.064 1.187-.067.037-.206 0-.282-.048a10.765 10.765 0 01-2.014-1.68c-1.73-1.814-2.082-4.787-.82-6.956a7.38 7.38 0 012.36-2.481c1.26-.824 4.77-2.907 5.235-3.192-.04-.052-.051-.08-.072-.093-.552-.322-1.1-.65-1.66-.957-.082-.045-.231-.028-.32.018-.308.159-.603.342-.902.517-.264.154-.527.31-.83.489l1.438.904c-.735.434-1.43.85-2.133 1.253-.056.032-.176.007-.237-.035a17.38 17.38 0 01-1.018-.74c-.145-.115-.241-.126-.403-.031a488.06 488.06 0 01-3.934 2.276c-.145.083-.192.18-.192.348.005 3.098.004 6.196-.001 9.293 0 .166.043.264.192.35 1.306.748 2.608 1.504 3.907 2.265.144.085.24.081.385-.016.932-.623 5.196-3.296 6.381-4.033.201-.125.37-.304.552-.458l-.03-.07h-4.426c.45-.782.87-1.52 1.305-2.249.04-.066.187-.094.285-.094 2.007-.005 4.015-.003 6.022-.003.08 0 .16.009.257.014.005.095.027.18.009.254-.132.549-.22 1.116-.42 1.64-.474 1.246-1.353 2.204-2.424 2.942-1.17.805-4.895 3-5.527 3.377.03.053.034.075.047.083.385.227.798.417 1.149.689.505.39.945.388 1.45 0 .364-.279.79-.476 1.231-.735l-1.464-.915c.04-.035.063-.063.092-.08.67-.389 1.34-.78 2.016-1.16.064-.035.194-.016.259.029zm2.894-9.337c.345.612.602 1.399.64 2.006-.678 0-1.332.004-1.987-.005-.06-.001-.154-.07-.173-.128-.32-.988-1.003-1.69-1.81-2.28-.573-.419-1.183-.788-1.776-1.18-.05-.032-.099-.067-.18-.123.135-.081.24-.146.348-.209.552-.32 1.1-.647 1.66-.955.1-.056.28-.09.361-.037 1.17.769 2.215 1.667 2.917 2.911z" />
                </g>
            </svg></a>
        <nav class="flex gap-5 items-center">
            <form action="index.php">
                <button type="submit" class="bg-white border-[1px] border-black px-2 py-1 rounded-lg text-xl hover:text-white" id="acceuil" style="box-shadow: 8px 8px 5px #7e1d50;">Accueil</button>
            </form>
            <?php if (isset($_SESSION["user"])) { ?>
                <form action="profil.php">
                    <button type="submit" class="bg-gwhite border-[1px] border-black px-2 py-1 rounded-lg text-xl hover:text-white" style="box-shadow: 8px 8px 5px #7e1d50;" id="profil">Profil</button>
                </form>
                <form action="logout.php">
                    <button type="submit" class="bg-white border-[1px] border-black px-2 py-1 rounded-lg text-xl hover:text-white" style="box-shadow: 8px 8px 5px #7e1d50;" id="deco">Déconnexion</button>
                </form>
            <?php } ?>
        </nav>
    </header>
    <main class="bg-cover bg-center bg-fixed bg-gray-300 py-10 flex flex-col items-center" style="background-image: url(https://static.vecteezy.com/ti/vecteur-libre/p3/265609-illustrationle-paysage-rouge-vectoriel.png)">
        <section class="flex items-center flex-col my-8">

            <form class="flex flex-col items-center gap-5 border-2 border-white p-5 rounded-lg w-[60vw] bg-[#7e1d50]" action="" method="post" style="box-shadow: 8px 8px 5px white;">
                <h1 class="text-center text-white text-2xl mb-2 underline">Création d'une catégorie:</h1>
                <input class="border-2 border-black p-1 rounded-lg w-full" type="text" name="categorie" id="" placeholder="Catégorie">
                <label class="text-white underline">Catégorie associée:</label>
                <select class="w-[50vw]" name="sous_categorie2">
                    <?php foreach ($bdd->getAllCategorie() as $categorie) { ?>
                        <option value="<?php print $categorie["id"] ?>"><?php print $categorie["name"] ?></option>
                    <?php } ?>
                </select>
                <input class="border-2 w-full border-black p-1 rounded-lg" type="text" name="sous_categorie" id="" placeholder="Sous-catégorie">
                <button class="border-2 border-black p-1 bg-white rounded-lg w-[10vw]" type="submit" name="ajouter">Ajouter</button>
            </form>
        </section>
        <?php foreach ($bdd->getAllCategorie() as $categorie) { ?>
            <section class="bg-[#7e1d50] h-auto w-[60vw] mb-10 pb-2 rounded-lg border-white border-[1px]" style="box-shadow: 8px 8px 5px white;">
                <article class="mx-2 mt-2 rounded-t-lg p-1">
                    <a href="categorie_extend.php?cat=<?= $categorie["id"] ?>">
                        <h2 class="text-white"><?= $categorie['name'] ?></h2>
                    </a>
                </article>
                <?php foreach ($bdd->getAllSousCategorie($categorie['id']) as $sous_categorie) { ?>
                    <section class="flex justify-between">
                        <article class="bg-white mb-2 rounded-lg p-1 border-b-[1px] border-red-500 mx-2 w-full">
                            <a href="sous_categorie_extend.php?cat=<?= $sous_categorie[0] ?>">
                                <h2><?= $sous_categorie["nom"] ?></h2>
                            </a>
                        </article>
                        <article>
                            <div class="flex gap-2 items-center mr-5 text-white">
                                <svg height="20px" width="20px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                                    <style type="text/css">
                                        .st0 {
                                            fill: #FFFFFF;
                                        }
                                    </style>
                                    <g>
                                        <path class="st0" d="M255.995,3.769C114.605,3.769,0,88.187,0,217.102c0,79.518,49.369,148.08,139.713,201.623l148.909,89.506
                                        l1.677-82.807C422.615,418.055,512,340.045,512,217.102C512,88.187,397.386,3.769,255.995,3.769z M288.175,387.319l-35.31,1.966
                                        l-0.717,35.366l-0.346,16.928l-92.635-55.686C78.876,338.313,38.161,281.519,38.161,217.102
                                        c0-115.006,109.583-175.172,217.834-175.172s217.844,60.167,217.844,175.172C473.839,317.211,404.429,380.843,288.175,387.319z" />
                                    </g>
                                </svg>
                                <p>0</p>
                            </div>
                        </article>
                    </section>
                <?php } ?>
            </section>
        <?php } ?>
    </main>
    <footer class="flex justify-between items-center pl-32 pr-32 h-24 border-t-[1px] border-[#ed231a]">
        <a href="index.php"><svg width="50px" height="50px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                <g fill="none" fill-rule="evenodd">
                    <circle cx="16" cy="16" r="16" fill="#7e1d50" />
                    <path fill="#FFF" d="M16.053 5c.53.319 1.056.645 1.59.956 2.535 1.47 5.07 2.938 7.608 4.402.167.096.241.203.241.408-.005 3.492-.004 6.984.008 10.476 0 .228-.104.323-.27.419-3.017 1.746-6.032 3.495-9.047 5.244-.046.027-.087.063-.13.095h-.11c-.91-.536-1.82-1.077-2.733-1.608-2.154-1.251-4.31-2.5-6.468-3.743-.183-.105-.243-.225-.242-.435.01-3.464.012-6.928.005-10.393 0-.248.085-.373.289-.49 2.989-1.724 5.973-3.454 8.958-5.184.069-.04.128-.098.191-.147h.11zm2.806 17.48c.413.283.817.58 1.233.88.023-.01.057-.024.088-.041 1.35-.781 2.703-1.56 4.049-2.35.08-.047.15-.185.15-.28.007-3.126.006-6.251-.003-9.376a.377.377 0 00-.156-.275c-1.33-.782-2.667-1.55-3.998-2.329-.138-.08-.215-.056-.332.035-.323.253-3.499 2.193-4.743 2.94-.972.582-1.922 1.196-2.674 2.07-1.037 1.205-1.134 2.875-.227 4.185.449.65 1.048 1.144 1.69 1.583.512.349 1.04.673 1.56 1.008-.014.02-.022.04-.036.048-.686.398-1.37.8-2.064 1.187-.067.037-.206 0-.282-.048a10.765 10.765 0 01-2.014-1.68c-1.73-1.814-2.082-4.787-.82-6.956a7.38 7.38 0 012.36-2.481c1.26-.824 4.77-2.907 5.235-3.192-.04-.052-.051-.08-.072-.093-.552-.322-1.1-.65-1.66-.957-.082-.045-.231-.028-.32.018-.308.159-.603.342-.902.517-.264.154-.527.31-.83.489l1.438.904c-.735.434-1.43.85-2.133 1.253-.056.032-.176.007-.237-.035a17.38 17.38 0 01-1.018-.74c-.145-.115-.241-.126-.403-.031a488.06 488.06 0 01-3.934 2.276c-.145.083-.192.18-.192.348.005 3.098.004 6.196-.001 9.293 0 .166.043.264.192.35 1.306.748 2.608 1.504 3.907 2.265.144.085.24.081.385-.016.932-.623 5.196-3.296 6.381-4.033.201-.125.37-.304.552-.458l-.03-.07h-4.426c.45-.782.87-1.52 1.305-2.249.04-.066.187-.094.285-.094 2.007-.005 4.015-.003 6.022-.003.08 0 .16.009.257.014.005.095.027.18.009.254-.132.549-.22 1.116-.42 1.64-.474 1.246-1.353 2.204-2.424 2.942-1.17.805-4.895 3-5.527 3.377.03.053.034.075.047.083.385.227.798.417 1.149.689.505.39.945.388 1.45 0 .364-.279.79-.476 1.231-.735l-1.464-.915c.04-.035.063-.063.092-.08.67-.389 1.34-.78 2.016-1.16.064-.035.194-.016.259.029zm2.894-9.337c.345.612.602 1.399.64 2.006-.678 0-1.332.004-1.987-.005-.06-.001-.154-.07-.173-.128-.32-.988-1.003-1.69-1.81-2.28-.573-.419-1.183-.788-1.776-1.18-.05-.032-.099-.067-.18-.123.135-.081.24-.146.348-.209.552-.32 1.1-.647 1.66-.955.1-.056.28-.09.361-.037 1.17.769 2.215 1.667 2.917 2.911z" />
                </g>
            </svg></a>
        <a href="contact.php">contact</a>
    </footer>
</body>

</html>