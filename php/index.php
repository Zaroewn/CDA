<?php declare(strict_types = 1);

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

$query = $pdo -> query('SELECT * FROM posts', PDO::FETCH_ASSOC);

$posts = $query -> fetchAll();

// var_dump($posts);

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
            <li><a href="update.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section class="grid">
        <?php
            foreach ($posts as $post) {
                echo "<div class=\"post\">",
                        "<a href=\"post.php?id=$post[id]\"><div class=\"picture\">",
                            "<img src=\"../src/$post[fichier_image]\">" ,
                        "</div></a>",
                        "<h2>" .$post['titre']. "</h2>",
                        "<span>" .$post['created_at']. "</span>",
                        "<p>" .$post['extrait']. "</p>",
                        "<button class=\"glow-on-hover\" onclick=\"location.href='post.php?id=$post[id]'\">Lire la suite</button>",
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