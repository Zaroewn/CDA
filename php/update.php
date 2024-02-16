<?php

// Utilisation de la fonction Require de la page function.php, pour pouvoir utiliser les fonctions.
require_once __DIR__ . '/functions.php';


// Connexion à la base de données
$pdo = new PDO('mysql:host=db;dbname=cda', 'root', '');

// Si mon formulaire a été soumis (superglobale $_POST non-vide)
if (!empty($_POST)) {
    $errors = [];
    // Vérification avec un If, que la variable $errors est vide'.
    if (!$errors) {
        try {

            // requête pour modifier un post en base de données avec la fonction updatePost().
            updatePost($pdo);

            header('location: ../php/validation.php');
            exit();
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}

// Récupération des valeurs du post choisi précédemment avec la fonction getPost()
$post = getPost($pdo);

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/src/livre.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/cud.css">
    <title>Modification d'un post</title>
</head>
<body>
    <header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="create.php">Créer un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section class="containeur">
        <h2>Modifier un post</h2>

        <!-- Utilisation de la fonction htmlspecialchars(), toujours dans un but sécuritaire pour éviter les failles XXS -->
        <form action="update.php" method="post">
            <label for="titre">Titre actuel du post :</label><br>
            <input type="text" name="titre" value="<?=htmlspecialchars($post['titre'])?>">
            <br><br>

            <input type="hidden" name="id" value="<?=htmlspecialchars($post['id'])?>">
            <br><br>

            <label for="corps">Contenu actuel du post :</label><br>
            <textarea name="corps" cols="30" rows="10"><?=htmlspecialchars($post['corps'])?></textarea>
            <br><br>

            <input type="submit" value="Modifier le post">
            <br><br>
            <a href="choixModif.php">Choisir un autre post</a>
        </form>
    </section>

    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>
</body>
</html>