<?php


// Utilisation de la fonction Require de la page function.php, pour pouvoir utiliser les fonctions.
require_once __DIR__ . '/functions.php';


// Connexion à la Base de données
$pdo = new PDO('mysql:host=db;dbname=cda', 'root', '');

// Vérification avec un If, que la superglobale POST n'est pas vide.
if (!empty($_POST)) {
    $errors = [];
    // Vérification avec un If, que la variable $errors est vide'.
    if (!$errors) {
        try {

            // requête pour supprimer un post en base de données avec la fonction deletePost.
            deletePost($pdo);

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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/src/livre.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/cud.css">
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
            <li><a href="choixModif.php">Modifier un post</a></li>
        </ul>
    </nav>

    <section class="containeur">
        <h2>Choisir le post à supprimer</h2>

        <form action="delete.php" method="post">
            <select name="id" id="id">
                <!-- Mise en place d'une boucle foreach pour itéré toutes les entrées de mon tableau contenu dans la variable $posts en créant une variable $post -->
                <?php foreach ($posts as $post) : ?>
                    <!-- Utilisation de la fonction htmlspecialchars(), toujours dans un but sécuritaire pour éviter les failles XXS -->
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