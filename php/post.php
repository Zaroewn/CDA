<?php 

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

$query = $pdo -> prepare('SELECT p.id, p.titre, p.corps, p.fichier_image, p.created_at, c.nom AS categorie_nom 
FROM posts p
LEFT JOIN categories c ON p.id_categorie = c.id
WHERE P.id = :id');

$query -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
$query -> execute();
$post = $query -> fetch(PDO::FETCH_ASSOC);
// var_dump($post);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/post.css">
    <title>BookX | Le meilleur de la lecture</title>
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

    <section class="grid">
        <?php
                echo "<div class=\"post\">",

                        "<h2>" .htmlspecialchars($post['titre']). "</h2>",

                        "<div class=\"corps\">",
                            "<img src=\"../src/" .htmlspecialchars($post['fichier_image']). "\">" ,
                            "<p>" .htmlspecialchars($post['corps']). "</p>",
                        "</div>",

                        "<div class=\"categorie\">",
                            "<h3>" .htmlspecialchars($post['categorie_nom']). " - " . "</h3>",
                        "<span>" .htmlspecialchars($post['created_at']). "</span>",
                    "</div>",

                    "</div>";
            
        ?>
    </section>

    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>

</body>
</html>
