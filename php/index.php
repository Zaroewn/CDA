<?php declare(strict_types = 1);

require_once __DIR__.'/functions.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

// Récupération des posts en Base de données via la fonction getPosts().
$posts = getPosts($pdo);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/index.css">
    <title>BookX | Le meilleur de la lecture</title>
</head>
<body>

    <header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="create.php">Créer un post</a></li>
            <li><a href="choixModif.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section class="grid">
        <?php
            // Utilisation de la fonction native htmlspecialchars() pour éviter toute faille XSS.
            foreach ($posts as $post) {
                echo "<div class=\"post\">",
                        "<a href=\"post.php?id=". htmlspecialchars(strval($post['id'])) . "\"><div class=\"picture\">",
                            "<img src=\"../src/" . htmlspecialchars($post['fichier_image']) . "\">" ,
                        "</div></a>",
                        "<h2>" .htmlspecialchars($post['titre']). "</h2>",
                        "<div class=\"categorie\">",
                            "<h3>" .htmlspecialchars($post['categorie_nom']). " - " . "</h3>",
                            "<span>" .htmlspecialchars($post['created_at']). "</span>",
                        "</div>",
                        "<p>" .htmlspecialchars($post['extrait']). "</p>",
                        "<button class=\"glow-on-hover\" onclick=\"location.href='post.php?id=" .htmlspecialchars(strval($post['id'])). "'\">Lire la suite</button>",
                    "</div>";
            }
        ?>
    </section>

    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>

</body>
</html>