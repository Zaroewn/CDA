<?php

require_once __DIR__.'/functions.php';

$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

// Si mon formulaire a été soumis (superglobale $_POST non-vide)
 if (!empty($_POST)) {
    $errors = [];

    if (!$errors) {
        try {
            $query = $pdo->prepare('UPDATE posts SET titre = :titre, corps = :corps, extrait = :extrait WHERE id = :id');
            $query->bindValue('titre', $_POST['titre'], PDO::PARAM_STR);
            $query->bindValue('corps', $_POST['corps'], PDO::PARAM_STR);
            $query->bindValue('extrait', substr($_POST['corps'], 0, 300), PDO::PARAM_STR);
            $query->bindValue('id', $_POST['id'], PDO::PARAM_INT);
            $query->execute();

            header('location: ../php/validation.php');
            exit();
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    }
}

// Récupération des valeurs du post choisi précédemment avec la fonction getPost()
$post = getPost($pdo, $_GET['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cud.css">
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