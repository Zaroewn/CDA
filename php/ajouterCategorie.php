<?php 
 $pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
 $statut = 'Veuillez rentrer une catégorie';
 $statut1 = 'La catégorie à bien été ajoutée';

//  $query = $pdo -> prepare('INSERT INTO posts (titre, corps, extrait, fichier_image, id_category)')
// requête pour entrer une nouvelle catégorie en base de données.
if (! empty($_POST['nom'])) {
    $query = $pdo->prepare('INSERT INTO categories (nom) VALUES (:nom)');
    $query->bindValue('nom', $_POST['nom'], PDO::PARAM_STR);
    $query->execute();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/ajouterCategorie.css">
    <title>Création d'une nouvelle catégorie</title>
</head>
<body>
    <header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="update.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section>
    <?php if (empty($_POST['nom'])) : ?>
            <h2><?= $statut?></h2>
        <?php else : ?>
            <h2><?= $statut1?></h2>
        <?php endif ?>
        <button onclick="location.href='create.php'">Retourner sur la page de création</button>
    </section>
</body>
</html>