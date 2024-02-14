<?php 

require_once __DIR__.'/functions.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

// Récupération du post sélectionné via son id avec la fonction getPost()
$post = getPost($pdo, $_GET['id']);
    // Si l'id du post n'existe pas, redirection vers une page 404
    if(empty($post)) {
        http_response_code(404);
        header('HTTP/1.0 404 Not Found');
        readfile('../html/404.html');
        exit();
    }

// Récupération des commentaires via l'id du post sélectionné avec la fonction getComments()
$commentaires = getComments($pdo, $_GET['id']);



$query = $pdo -> query('SELECT id, nom FROM utilisateurs');
$users = $query -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/post.css">
    <script type="module" src="../js/createUser.js"> defer</script>
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

    <section class="commentaires">
        <h3>Commentaires</h3>
        <hr><br>
        <?php foreach($commentaires as $commentaire) : ?>
                            <div class="commentaire">
                                <div class="img">
                                    <img src="../src/<?=htmlspecialchars($commentaire['photo'])?>">
                                    <div class="info">
                                        <h5><?=htmlspecialchars($commentaire['nom'])?></h5>
                                        <span><?=htmlspecialchars($commentaire['created_at'])?></span>
                                    </div>
                                </div>
                                <p><?=htmlspecialchars($commentaire['corps'])?></p>
                            </div>
                            <br>
                    <?php endforeach ?>
    </section>
    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>

</body>
</html>
