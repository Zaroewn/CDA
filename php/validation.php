<?php 
 $statut = 'L\'article a bien été modifié.';
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
            <li><a href="create.php">Créer un post</a></li>
            <li><a href="update.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section>
    
            <h2><?= $statut?></h2>
        <button onclick="location.href='choixModif.php'">Retourner sur la page du choix des posts</button>
    </section>
</body>
</html>