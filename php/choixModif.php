<?php

 $pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

// Récupération des posts dans le <select>
$query = $pdo -> query('SELECT id, titre, corps FROM posts');
$posts = $query -> fetchAll(PDO::FETCH_ASSOC);
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
        <h2>Choisir le post à modifier</h2>

        <form action="update.php" method="get">
            <select name="id" id="post">
                <?php foreach ($posts as $post) : ?>
                    <option value="<?=htmlspecialchars(strval($post['id']))?>"><?=htmlspecialchars($post['id'])?> - <?=htmlspecialchars($post['titre'])?></option>
                <?php endforeach ?>
            </select>
            <br><br>
            <input type="submit" value="Sélectionner ce post">
            <br><br>
        </form>
    </section>

</body>
</html>