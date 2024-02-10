<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cud.css">
    <title>Création d'un nouveau post</title>
</head>
<body>

<header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="create.php">Créer un post</a></li>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <h2>Créer un nouveau post</h2>

    <form action="create.php" method="post">

        <label for="title">Titre du post :</label><br>
        <input type="text" name="title" placeholder="Titre du post">
        <br><br>
        <label for="body">Contenu du post :</label><br>
        <textarea name="body" cols="30" rows="10" placeholder="Écrivez votre post ici"></textarea>
        <br><br>
        <label for="body">Contenu de l'extrait du post :</label><br>
        <textarea name="excerpt" cols="" rows="" placeholder="Écrivez l'extrait du post ici" maxlength="150"></textarea>
        <br><br>
        <input type="submit" value="Créer le post">

    </form>

    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>
</body>
</html>