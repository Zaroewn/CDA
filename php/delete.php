<?php

require_once __DIR__.'/functions.php';

$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

if (!empty($_POST)) {
    $errors = [];

    if (!$errors) {
        try {
            deletePost($pdo, $_POST['id']);
            echo "Le post a bien été supprimé";
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la suppression : " . $e->getMessage();
        }
    }
}

// Récupération des posts de le <select>
$query = $pdo -> query('SELECT id, titre FROM posts');
$posts = $query -> fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cud.css">
    <title>Suppression d'un post</title>
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
        </ul>
    </nav>

    <section class="containeur">
        <h2>Choisir le post à supprimer</h2>

        <form action="delete.php" method="post">
            <select name="id" id="id">
                <?php foreach ($posts as $post) : ?>
                    <option value="<?=htmlspecialchars($post['id'])?>"><?=htmlspecialchars($post['id'])?> - <?=htmlspecialchars($post['titre'])?></option>
                <?php endforeach ?>
            </select>
            <br><br>
            <input type="submit" value="Supprimer ce post">
            <br><br>
        </form>
    </section>
</body>
</html>