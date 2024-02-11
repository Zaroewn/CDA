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

if(empty($post)) {

    http_response_code(404);
    header('HTTP/1.0 404 Not Found');
    readfile('../html/404.html');
    exit();

}
// var_dump($post);

$query = $pdo -> prepare('SELECT commentaires.corps, commentaires.created_at, utilisateurs.nom, utilisateurs.photo 
FROM commentaires
LEFT JOIN utilisateurs
ON commentaires.id_utilisateur = utilisateurs.id
WHERE id_post = :id');

$query -> bindValue('id', $_GET['id'], PDO::PARAM_INT);
$query -> execute();
$commentaires = $query -> fetchAll(PDO::FETCH_ASSOC);

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

    <section class="commentaires">
        <h3>Commentaires</h3>
        <hr><br>
        <?php foreach($commentaires as $commentaire) : ?>
                            <div class="commentaire">
                                <div class="img">
                                    <img src="../src/<?=$commentaire['photo']?>">
                                    <div class="info">
                                        <h5><?=$commentaire['nom']?></h5>
                                        <span><?=$commentaire['created_at']?></span>
                                    </div>
                                </div>
                                <p><?=$commentaire['corps']?></p>
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
