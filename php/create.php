<?php

// Utilisation de la fonction Require de la page function.php, pour pouvoir utiliser les fonctions.
require_once __DIR__.'/functions.php';

// Connexion à la Base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

$statut = '*Veuillez renseigner tout les champs';
$statut1 = 'Nouvelle article crée :)';

// Mise en place d'une structure Try/Catch pour capturer les éventuelles erreurs
try {
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Vérifie si la taille de l'image est inférieure ou égale à 3 Mo
        if ($_FILES['image']['size'] <= 3000000) {
            $informationsImage = pathinfo($_FILES['image']['name']);
            $extensionImage = $informationsImage['extension'];
            $extensionsArray = array('png', 'jpg', 'gif', 'JPEG');

            // Vérifie si l'extension est autorisée (présente dans notre tableau $extensionsArray)
            if (in_array($extensionImage, $extensionsArray)) {
                move_uploaded_file($_FILES['image']['tmp_name'], '../src/' . basename($_FILES['image']['name']));
            } else {
                throw new Exception("L'extension du fichier n'est pas autorisée.");
            }
        } else {
            throw new Exception("La taille du fichier dépasse la limite autorisée (3 Mo).");
        }
    }
    // Vérifie que la superglobale $_POST est bien renseignée est non-vide.
    if (!empty($_POST['titre']) && !empty($_POST['corps']) && !empty($_FILES['image']['name']) && !empty($_POST['categorie'])) {
        // Création du post avec la fonction createPost
        createPost($pdo);
    }
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}

// Récupération des catégories pour l'input <select>, afin de pouvoir choisir une catégorie à affecter à notre nouveau post, avec une requête SQL.
$query = $pdo -> query('SELECT id, nom FROM categories ORDER BY created_at ASC');
$categories = $query -> fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cud.css">
    <script type="module" src="../js/create.js"> defer</script>
    <title>Création d'un nouveau post</title>
</head>
<body>
    <header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="choixModif.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section class="containeur">
        <h2>Créer un nouveau post</h2>

        <form action="create.php" method="post" enctype="multipart/form-data">
            <label for="titre">Titre du post :</label><br>
            <input type="text" name="titre" placeholder="Titre du post">
            <br><br>

            <label for="corps">Contenu du post :</label><br>
            <textarea name="corps" cols="30" rows="10" placeholder="Écrivez votre post ici"></textarea>
            <br><br>

            <label for="categorie">Catégorie du post :</label><br>
            <select name="categorie" id="categorie">
                <!-- Mise en place d'une boucle foreach pour itéré toutes les entrées de mon tableau contenu dans la variable $categories en créant une variable $categorie -->
                <?php foreach ($categories as $categorie) : ?>
                    <!-- Utilisation de la fonction htmlspecialchars(), toujours dans un but sécuritaire pour éviter les failles XXS -->
                    <option value="<?=htmlspecialchars($categorie['id'])?>"><?=htmlspecialchars(strval($categorie['id']))?> - <?=htmlspecialchars($categorie['nom'])?></option>
                <?php endforeach ?>
            </select>
            <h4 id="addCategory">Ajouter une catégorie</h4>
            <br><br>

            <label for="image">Image du post :</label><br>
            <input type="file" name="image"/>
            <br><br>

            <input type="submit" value="Créer le post">
        </form>
        <!-- Structure If/Else pour envoyer un message d'échec ou de réussite lors de la création du nouveau post -->
        <?php if (empty($_POST['titre']) || empty($_POST['corps']) || empty($_FILES['image']['name']) || empty($_POST['categorie'])) : ?>
            <h3><?= $statut?></h3>
        <?php else : ?>
            <h3><?= $statut1?></h3>
        <?php endif ?>
    </section>

    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>
</body>
</html>