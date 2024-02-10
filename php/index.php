<?php declare(strict_types = 1);

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

$query = $pdo -> query('SELECT p.id, p.titre, p.extrait, p.fichier_image, p.created_at, c.nom AS categorie_nom 
FROM posts p
LEFT JOIN categories c ON p.id_categorie = c.id');

$posts = $query -> fetchAll(PDO::FETCH_ASSOC);

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
                        "<div class=\"categorie\">",
                            "<h3>" .$post['categorie_nom']. " - " . "</h3>",
                            "<span>" .$post['created_at']. "</span>",
                        "</div>",
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