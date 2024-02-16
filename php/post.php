<?php

// Utilisation de la fonction Require de la page function.php, pour pouvoir utiliser les fonctions.

require_once __DIR__ . '/functions.php';

// Connexion à la base de données
$pdo = new PDO('mysql:host=db;dbname=cda', 'root', '');

// Récupération du post sélectionné via son id avec la fonction getPost()
$post = getPost($pdo);
// Si l'id du post n'existe pas, redirection vers une page 404
if(empty($post)) {
    http_response_code(404);
    header('Location: /html/404.html');
    exit();
}

// Récupération des commentaires via l'id du post sélectionné avec la fonction getComments()
$commentaires = getComments($pdo);

// Vérification avec un If, que la superglobale POST et POST['corps']n'est pas vide pour éviter d'envoyer un commentaire sans texte.
if(! empty($_POST) && ! empty($_POST['corps'])) {
    // Ajout du commentaire en Base de données via la fonction addComment().
    $addComment = addComment($pdo);
    // Redirection vers la page du post ou le commentaire à été envoyé avec la fonction native header().
    header('Location: post.php?id=' . $_GET['id']);
}

// Récupération des info de l'utilisateur dans le <select> , avec une requête SQL, pour choisir l'utilisateur qui laisse un commentaire.
$query = $pdo -> query('SELECT id, nom FROM utilisateurs');
$users = $query -> fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/src/livre.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="/css/post.css">
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
        <!-- Utilisation de la fonction htmlspecialchars(), toujours dans un but sécuritaire pour éviter les failles XXS -->
        <?php

                echo
                    "<h2>" . htmlspecialchars($post['titre']) . "</h2>",
"<div class=\"corps\">",
"<img src=\"../src/" . htmlspecialchars($post['fichier_image']) . "\">" ,
"<p>" . htmlspecialchars($post['corps']) . "</p>",
"</div>",
"<div class=\"categorie\">",
"<h3>" . htmlspecialchars($post['categorie_nom']) . " - " . "</h3>",
"<span>" . htmlspecialchars($post['created_at']) . "</span>",
"</div>";
?>

    </section>

    <section class="commentaires">
        <h3>Commentaires</h3>
        <hr><br>
            <!-- Mise en place d'une boucle foreach pour itéré toutes les entrées de mon tableau contenu dans la variable $commentaires en créant une variable $commentaire  -->
            <!-- Utilisation de la fonction native htmlspecialchars() pour éviter toute faille XSS. -->
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

    <section class="commentaires">
        <h3>Laisser un commentaire</h3>
        <hr><br>
        <form action="" method="post">
            <p>
            <label for="user">Sélectionner un utilisateur :</label>
            <select name="user" id="user">
                <!-- Mise en place d'une boucle foreach pour itéré toutes les entrées de mon tableau contenu dans la variable $users en créant une variable $user  -->
                <!-- Utilisation de la fonction native htmlspecialchars() pour éviter toute faille XSS. -->
                <?php foreach ($users as $user) : ?>
                    <option value="<?=htmlspecialchars($user['id'])?>"><?=htmlspecialchars($user['id'])?> - <?=htmlspecialchars($user['nom'])?></option>
                <?php endforeach ?>
            </select>
            <br><br>
                </p>
            <textarea name="corps" cols="30" rows="10" placeholder="Écrivez votre commentaire ici"></textarea>
            <br><br>
            
            <input type="submit" value="Envoyer le commentaire">
            </form>
    </section>
    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>

</body>
</html>



