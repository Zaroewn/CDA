<?php

// Utilisation de la fonction Require de la page function.php, pour pouvoir utiliser les fonctions.
require_once __DIR__.'/functions.php';

// Connexion à la base de données
 $pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

 $statut = 'Veuillez rentrer une catégorie';
 $statut1 = 'La catégorie à bien été ajoutée';

// Vérification avec un If, que la superglobale POST['nom'] n'est pas vide
if (! empty($_POST['nom'])) {
    // requête pour entrer une nouvelle catégorie en base de données avec la fonction addCategorie.
    addCategorie($pdo);

}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajouterCategorie.css">
    <title>Création d'une nouvelle catégorie</title>
</head>
<body>
    <header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="create.php">Créer un post</a></li>
            <li><a href="update.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section>
        <!--  La structure If/Else vérifie ici si la superglobale $_POST['nom'] est vide ou non, est affecte un message en fonction de la réponse-->
        <?php if (empty($_POST['nom'])) : ?>
            <h2><?= $statut?></h2>
        <?php else : ?>
            <h2><?= $statut1?></h2>
        <?php endif ?>
        <button onclick="location.href='create.php'">Retourner sur la page de création</button>
    </section>
</body>
</html>